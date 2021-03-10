<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/schimaDefine.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/filter.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/sendMail.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/encrypt_decrypt.model.php';


if ((new Session())->SessionStatus() === false){
    header("Location: ../view/php/login.view.php");
	exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || $_POST['submit'] !== 'Submit'){
	header("Location: ../view/php/settings.view.php?error=method not valid");
	exit;
}

$uid = $_SESSION['uid'];
$usr_info = (new dbselect())->select($DB_SELECT['_id'], 'firstname, lastname, login, email, notif', 'Users', $uid, $PARAM['int'], 0);

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$login = $_POST['login'];
$email = $_POST['email'];
$oldPwd = $_POST['oldPasswd'];
$newPwd = $_POST['newPasswd'];
$confPwd = $_POST['confnewPasswd'];
$notf = $_POST['notif'];
$new_info = array();
$param = array();
$select = '';
$error = '';
$sp = '';
$seccess = '';
// $target_file = '';

if (!empty($firstName) && $firstName !== $usr_info['firstname']){
	if(filter_name($firstName) === false){
		$error = '?error='.$ERROR;
	}
	$select = 'firstname=? ';
	array_push($param, $PARAM['str']);
	array_push($new_info, $firstName);
}
if (empty($error) && !empty($lastName) && $lastName !== $usr_info['lastname']){
	if(filter_name($lastName) === false){
		$error = '?error='.$ERROR;
	}
	$sp = !empty($select) ? ',' : '';
	$select .= $sp.'lastname=? ';
	array_push($param, $PARAM['str']);
	array_push($new_info, $lastName);
}
if (empty($error) && !empty($login) && $login !== $usr_info['login']){
	if(filter_login($login) === false){
		$error = '?error='.$ERROR;
	}
	else if (exist_login($login) === true)
		$error = '?error=login is ready exist';
	if (file_exists($_SERVER['DOCUMENT_ROOT'].'/public/usersData/'.$login))
		$error = '?error= cannot modify login';
	$sp = !empty($select) ? ',' : '';
	$select .= $sp.'login=? ';
	array_push($param, $PARAM['str']);
	array_push($new_info, $login);
}
if (empty($error) && $notf !== $usr_info['notif'] && ($notf === 'true' || $notf === 'false')){
	$sp = !empty($select) ? ',' : '';
	$select .= $sp.'notif=? ';
	array_push($param, $PARAM['str']);
	array_push($new_info, $notf);
}

if (empty($error) && !empty($oldPwd) && !empty($newPwd) && !empty($confPwd)){
	$hashpwd = hash('whirlpool', 'ali'.$oldPwd.'zaynoune');
	if (filter_pwd($oldPwd) === false)
		$error = '?error='.$ERROR;
	else if (exist_pwd($login, $hashpwd) === false)
		$error = '?error=passowrd invalide';
	if (empty($error)){
		if (filter_pwd($newPwd) === false)
			$error = '?error'.$ERROR;
	}

	if (empty($error)){
		if (filter_config_pwd($newPwd, $confPwd) === false)
			$error = '?error='.$ERROR;
		else if (filter_config_pwd($oldPwd, $newPwd) === true)
			$error = '?error=old passwd = new passwd';
	}
	if (empty($error)){
		$hashpwd = hash('whirlpool', 'ali'.$newPwd.'zaynoune');
		$sp = !empty($select) ? ',' : '';
		$select .= $sp.'pwd=? ';
		array_push($param, $PARAM['str']);
		array_push($new_info, $hashpwd);
	}
}

// valid_avatar ///////////////////////////

if (empty($error) && !empty($_FILES['img_user']) && !empty($_FILES["img_user"]["tmp_name"])){
	$check = getimagesize($_FILES["img_user"]["tmp_name"]);
	if ($check !== false){
		$file = basename($_FILES['img_user']["name"]);
		$exten = (strtolower(pathinfo($file,PATHINFO_EXTENSION)));
		if ($exten !== 'jpg' && $exten !== 'jpeg' && $exten !== 'png')
			$error = '?error=extension image not support';
		else{
			$Path = '/public/usersData/'.$login.'/';
			
			$target_file = 'avatar'.'.'.$exten;
			if (move_uploaded_file($_FILES["img_user"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'].$Path.$target_file)){
				$seccess = '?success=your avatar has successfly update';
				$oldavatar = (new dbselect())->select($DB_SELECT['_uid'], 'url', 'Avatar', $uid, $PARAM['int'], 0);
				if ($target_file !== $oldavatar){
					(new dbinsert())->update($DB_UPDATE['_uid'], 'Avatar', 'url=?', array($target_file, $uid), array($PARAM['str'], $PARAM['int']), 0);
				}
			}
			else
				$error = '?error=please chose an other avatar we cant change it';
		}
	}
}

if (empty($error)){
	if (!empty($email) && $email !== $usr_info['email']){
		if (filter_email($email) === false)
			$error = '?error'.$ERROR;
		else if (exist_email($email) === true)
			$error = '?error=email is ready exist';
		else{
			$token = md5(rand(1000, 5000));
			(new dbinsert())->insert(
				$DB_INSERT['_email_user'],
				array($uid , $email, $token),
				array($PARAM['int'], $PARAM['str'], $PARAM['str']),
				0
			);
			send_mail($uid, $login, $email, $token, 'update');
			$seccess = '?success=we send you link activision to your email please activate it';
		}
	}
}

if (!empty($error)){
	header("Location: ../view/php/settings.view.php".$error);
	exit;
}


if (!empty($select)){
	array_push($new_info, $uid);
	array_push($param, $PARAM['int']);
	(new dbinsert())->update($DB_UPDATE['_id'], 'Users', $select, $new_info, $param);
	if (!empty($login) && $login !== $usr_info['login']){
		if (!file_exists($_SERVER['DOCUMENT_ROOT'].'/public/usersData/'.$usr_info['login'])){
			if ((!mkdir($_SERVER['DOCUMENT_ROOT'].'/public/usersData/'.$login, 0777, true))){
				header("Location: ../view/php/settings.view.php?error=creat directory!");
				exit();
			}
		}
		else{
			rename($_SERVER['DOCUMENT_ROOT'].'/public/usersData/'.$usr_info['login'],
					$_SERVER['DOCUMENT_ROOT'].'/public/usersData/'.$login);
		}
		$name_path = $_SERVER['DOCUMENT_ROOT'].'/public/usersData/'.$login;
	}
	(new Session())->logout();
	(new Session())->start($login);
	header("Location: ../view/php/settings.view.php?success=your information was successfully updated!");
}
else if (!empty($seccess))
header("Location: ../view/php/settings.view.php".$seccess);
else if (empty($select)){
	header("Location: ../view/php/settings.view.php?error=none information to update!");
}


?>