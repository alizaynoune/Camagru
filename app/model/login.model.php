<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/auth.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/filter.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes.php';

$login = $_POST['login'];
$pwd = $_POST['passwd'];

function    filter_inputs(){
    global $login, $pwd, $ERROR;
    if (empty($login) || empty($pwd)){
        $ERROR = "empty login or password";
        return(false);
    }
    $pwd = hash('whirlpool', 'ali'.$pwd.'zaynoune');
    if (auth($login, $pwd) === false){
        return(false);
    }
    return(true);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || $_POST['submit'] !== 'OK' || filter_inputs() === false){
    $ERROR = (!empty($ERROR)) ? '?error='.$ERROR : '';
    header('HTTP/1.1 307 Temporary Redirect');
	header("Location: ../view/php/login.view.php".$ERROR);
	exit();
}
else{
    header("Location: ../view/php/profile.view.php");
}
?>