<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/schimaDefine.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes.php';
function    filter_email($email){
	global $ERROR;
	$ERROR = 'email';
	$reg = '/^[a-zA-Z0-9]+([\w-\+\!\#\$\%\&\'\*\=\?\^\`\{\|]+[\.]{0,1})+[a-zA-Z0-9]+@([a-z0-9]{1})+(\.{0,1}[a-z0-9-]+)*(\.[a-z]{2,4})$/';
	if (strlen($email) > 50 || !preg_match($reg, $email))
		return(false);
	$ERROR = "";
	return(true);
}

function    filter_login($login){
	global $ERROR;
	$ERROR = 'login invalide';
	$REG = "/^[\w-]+$/";
	if (strlen($login) < 8 || strlen($login) > 20 || !preg_match($REG, $login))
		return(false);
	$ERROR = "";
	return(true);
}

function    filter_name($name){
	global $ERROR;
	$ERROR = 'firstname or last name invalide';
	$reg = '/^[a-zA-Z]+$/';
	if (strlen($name) > 20 || strlen($name) < 3 || !preg_match($reg, $name))
		return(false);
	$ERROR = "";
	return (true);
}

function    filter_pwd($pwd){
	global $ERROR;
	$ERROR = 'password invalid';
	if (strlen($pwd) < 8 || strlen($pwd) > 20)
		return(false);
	if (!preg_match('/^.*[a-z].*$/', $pwd))
		return(false);
	if (!preg_match('/^.*[A-Z].*$/', $pwd))
		return(false);
	if (!preg_match('/^.*[0-9].*$/', $pwd))
		return(false);
	if (!preg_match('/^.*[~!@#$%^&*()\_\-\+=\\\.\?<>,\[\]\{\}:\'";\/].*$/', $pwd))
		return(false);
	$ERROR = "";
	return(true);
}

function    filter_config_pwd($pwd, $cnfpwd){
	global $ERROR;
	if ($pwd === $cnfpwd)
		return(true);
	$ERROR = 'password confirm not mach';
		return(false);
}

function    filter_comment($comment){
	if (strlen($comment) > 255)
		return(false);
}

function    exist_email($email){
	global $DB_SELECT, $PARAM;	
	$rslt = (new dbselect())->select($DB_SELECT['_email'], 'email', 'Users', $email, $PARAM['str']);
	if (empty($rslt))
		return(false);
	return(true);
}

function    exist_login($login){
	global $DB_SELECT, $PARAM;
		
	$rslt = (new dbselect())->select($DB_SELECT['_login'], 'login', 'Users', $login, $PARAM['str']);
	if (empty($rslt))
		return(false);
    return(true);
}

function	exist_pwd($login, $pwd){
	global $DB_SELECT, $PARAM;
	$rslt = (new dbselect())->select($DB_SELECT['_login'], 'pwd', 'Users', $login, $PARAM['str']);
	if (empty($rslt) || $pwd !== $rslt['pwd'])
		return(false);
    return(true);
}

?>