<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/schimaDefine.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/filter.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/sendMail.model.php';

if (!isset($_SESSION) || empty($_SESSION['login'])){
	session_destroy();
	header("Location: ../view/php/login.view.php");
	exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || $_POST['submit'] !== 'Submit'){
	// $ERROR = (!empty($ERROR)) ? "?error=".$ERROR : '';
	// header('HTTP/1.1 307 Temporary Redirect');
	header("Location: ../view/php/settings.view.php?error=method not valid");
	exit;
}

$usr_info = (new dbselect())->select($DB_SELECT['_id'], 'firstname, lastname, login, email, notif', 'Users', $_SESSION['uid'], $PARAM['int']);

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
	$select .= 'lastname=? ';
	array_push($param, $PARAM['str']);
	array_push($new_info, $lastName);
}
if (empty($error) && !empty($login) && $login !== $usr_info['login']){
	if(filter_login($login) === false){
		$error = '?error='.$ERROR;
	}
	else if (exist_login($login) === true)
		$error = '?error=login is ready exist';
	$select .= 'login=? ';
	array_push($param, $PARAM['str']);
	array_push($new_info, $login);
}
if (empty($error) && $notf !== $usr_info['notif'] && ($notf === 'true' || $notf === 'false')){
	$select .= 'notif=? ';
	array_push($param, $PARAM['bool']);
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
		$select .= 'pwd=? ';
		array_push($param, $PARAM['str']);
		array_push($new_info, $hashpwd);
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
				array($_SESSION['uid'] , $email, $token),
				array($PARAM['int'], $PARAM['str'], $PARAM['str']),
				0
			);
			// send_mail($PARAM['int'], $login, $email, $token);
			// chage to update email ///////////////////
		}
	}
	// if (empty($error)){

	// }
}

if (!empty($error)){
	header("Location: ../view/php/settings.view.php".$error);
	exit;
}


if (!empty($new_info)){
	
}

print_r($select);
echo '</br>';
print_r($new_info);
echo '</br>';
print_r($param);
?>