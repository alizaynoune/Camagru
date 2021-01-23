<?php
function    filter_email($email){

}

function    filter_login($login){

}

function    filter_name($name){

}

function    filter_pwd($pwd){

}

function    filter_inputs(){
    return(0);

}

if (filter_inputs() == 0){
	header("Location: ../view/php/SignUp.php");
	exit;
}

?>