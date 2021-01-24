<?php


function    filter_inputs(){
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$login = $_POST['login'];
	$email = $_POST['email'];
	$pwd = $_POST['passwd'];
	$cnfpwd = $_POST['confPasswd'];
	if (empty($firstName) || empty($lastName) || empty($login) || empty($email) || empty($pwd) || empty($cnfpwd))
		return(false);
	
	
}

if ($_SERVER['REQUSET_METHOD'] !== 'POST' || $_POST['submit'] !== 'OK' || filter_inputs() == false){
	header('HTTP/1.1 307 Temporary Redirect');
	header("Location: ../view/php/SignUp.php");
	exit;
}

print_r($_POST);

?>