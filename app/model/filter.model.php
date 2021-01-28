<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
function    filter_email($email){
	if (strlen($email) > 50 || !filter_var($email, FILTER_VALIDATE_EMAIL))
		return(false);
	return(true);
}

function    filter_login($login){
	$REG = "/^[\w-]+$/";
	if (strlet($login) < 8 || strlen($login) > 15)
		return(false);
}

function    filter_name($name){
	
	if (strlen($name) > 10)
		return(false);
}

function    filter_pwd($pwd){
	if (strlen($pwd) < 8 || strlen($pwd) > 20)
		return(false);
}

function    filter_config_pwd($pwd, $cnfpwd){
	if ($pwd === $cnfpwd)
		return(true);
	return(false);
}

function    filter_comment($comment){
	if (strlen($comment) > 255)
		return(false);
}

function    exist_email($email){

	$select = new dbselect();
	$rslt = $select->select($DB_SELECT['_email'], array(''));
	// $new_get = new DBGet();
	// $rslt = $new_get->select('email', 'Users', 'email', $email);
	if (!empty($rslt))
		return(true);
	return(false);
}

function    exist_login($login){
	$new_get = new DBGet();
	$rslt = $new_get->select('login', 'Users', 'login', $login);
	if (!empty($rslt))
		return(true);
    return(false);
}

function	exist_pwd($login, $pwd){
	$new_get = new DBGet();
	$rslt = $new_get->select('pwd', 'Users', 'login', $login);
	if (empty($rslt) || $pwd !== $rslt['pwd'])
		return(false);
    return(true);
}

?>