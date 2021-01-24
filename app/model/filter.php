<?php
function    filter_email($email){
	if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		return(false);
	return(true);
}

function    filter_login($login){

}

function    filter_name($name){

}

function    filter_pwd($pwd){

}

function    filter_config_pwd($pwd, $cnfpwd){
	if ($pwd === $cnfpwd)
		return(true);
	return(false);
}

function    filter_comment($comment){

}

function    exist_email($email){
	return(true);// if exist in database
}

function    exist_login($login){
    return(true);// if exist in database
}

?>