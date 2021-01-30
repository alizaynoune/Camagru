<?php

echo filter_pwd($argv[1]).PHP_EOL;

function    filter_email($email){
	$reg = '/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}.*$/';
	if (strlen($email) > 50 || !preg_match($reg, $email))
		return(0);
	return(1);
}

function    filter_login($login){
	$REG = "/^[\w-]+$/";
	if (strlen($login) < 8 || strlen($login) > 15 || !preg_match($REG, $login))
		return(0);
	return(1);
}

function    filter_name($name){
	$reg = '/^[a-zA-Z]+$/';
	if (strlen($name) > 10 || !preg_match($reg, $name))
		return(0);
	return (1);
}

function    filter_pwd($pwd){
	if (strlen($pwd) < 8 || strlen($pwd) > 20)
		return(0);
	if (!preg_match('/^.*[a-z].*$/', $pwd))
		return(0);
	if (!preg_match('/^.*[A-Z].*$/', $pwd))
		return(0);
	if (!preg_match('/^.*[0-9].*$/', $pwd))
		return(0);
	if (!preg_match('/^.*[~!@#$%^&*()\_\-\+=\\\.\?<>,\[\]\{\}:\'";\/].*$/', $pwd))
		return(0);
	return(1);
}

?>
