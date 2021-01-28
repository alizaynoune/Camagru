<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/insert.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/schimaDefine.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/filter.model.php';

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$login = $_POST['login'];
$email = $_POST['email'];
$pwd = $_POST['passwd'];
$cnfpwd = $_POST['confPasswd'];

function    filter_inputs(){
	global $firstName, $lastName, $login, $email, $pwd, $cnfpwd;
	if (empty($firstName) || empty($lastName) || empty($login) || empty($email) || empty($pwd) || empty($cnfpwd))
		return(false);
	if (exist_login($login) === true || exist_email($email) === true)
		return(false);
	$pwd = hash('whirlpool', 'ali'.$pwd.'zaynoune');
	return(true);
	
	
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || $_POST['submit'] !== 'OK' || filter_inputs() == false){
	header('HTTP/1.1 307 Temporary Redirect');
	header("Location: ../view/php/signup.view.php");
	exit;
}
else{
	insert_User($DB_INSERT['_user']." ( '".$login."', '".$firstName."', '".$lastName."', '".$email. "', '".$pwd. "', NOW())");
	header("Location: ../view/php/CreateSuccess.view.php");
}

?>