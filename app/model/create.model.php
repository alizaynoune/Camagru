<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/schimaDefine.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/filter.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/sendMail.model.php';

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$login = $_POST['login'];
$email = $_POST['email'];
$pwd = $_POST['passwd'];
$cnfpwd = $_POST['confPasswd'];

/////////////////// creat new Users //////////////////////
function    filter_inputs(){
	global $firstName, $lastName, $login, $email, $pwd, $cnfpwd, $ERROR;
	$ERROR = "";
	if (empty($firstName) || empty($lastName) || empty($login) || empty($email) || empty($pwd) || empty($cnfpwd))
		return(false);
	if (filter_name($firstName) === false || filter_name($lastName) === false ||
		filter_login($login) === false || filter_email($email) === false ||
		filter_pwd($pwd) === false || filter_config_pwd($pwd, $cnfpwd) === false)
		return(false);
	if (exist_login($login) === true){
		$ERROR = 'login already exists';
		return(false);
	}
	if (exist_email($email) === true){
		$ERROR = 'email already exists';
		return(false);
	}
	$pwd = hash('whirlpool', 'ali'.$pwd.'zaynoune');
	return(true);
	
	
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || $_POST['submit'] !== 'OK' || filter_inputs() == false){
	$ERROR = (!empty($ERROR)) ? "?error=".$ERROR : '';
	header('HTTP/1.1 307 Temporary Redirect');
	header("Location: ../view/php/signup.view.php".$ERROR);
	exit;
}
else{
	$id = (new dbinsert())->insert(
		$DB_INSERT['_user'],
		array($login , $firstName, $lastName, $pwd),
		array($PARAM['str'], $PARAM['str'], $PARAM['str'], $PARAM['str']),
		1
	);
	if ($id === false){
		header("Location: http://".$_SERVER["HTTP_HOST"].'/app/view/php/signup.view.php?error=sorry we cant create your account');
		exit();
	}
	$token = md5(rand(1000, 5000));
	$ret_insert = (new dbinsert())->insert(
				$DB_INSERT['_email_user'],
				array($id['id'] , $email, $token),
				array($PARAM['int'], $PARAM['str'], $PARAM['str']),
				0
			);
	if ($ret_insert === false){
		header("Location: http://".$_SERVER["HTTP_HOST"].'/app/view/php/signup.view.php?error=sorry we cant create your account');
		exit();
	}
	send_mail($id['id'], $login, $email, $token, 'active');
	$ms1 = 'Your account was successfully created';
	$ms2 = 'open your email and click the activation link to activate your account.';
	$ms3 = 'If you do not see your account information in your inbox within 60 seconds please check your spam';
	header('HTTP/1.1 307 Temporary Redirect');
	header("Location: http://".$_SERVER["HTTP_HOST"].'/app/view/php/login.view.php?success=!'. $ms1 .'</br>'. $ms2 . '</br>' . $ms3);
	exit();
}
?>