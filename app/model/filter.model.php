<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/schimaDefine.php';
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
	else
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