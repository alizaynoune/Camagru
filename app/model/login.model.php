<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/auth.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/filter.model.php';

$login = $_POST['login'];
$pwd = $_POST['passwd'];
$_error_ ;

function    filter_inputs(){
    global $login, $pwd, $_error_;
    if (empty($login) || empty($pwd)){
        $_error_ = "empty login or password";
        return(false);
    }
    $pwd = hash('whirlpool', 'ali'.$pwd.'zaynoune');
    if (auth($login, $pwd) === false){
        $GLOBALS['_error_'] = "incorrect login or password";
        return(false);
    }
    return(ture);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || $_POST['submit'] !== 'OK' || filter_inputs() === false){
    header('HTTP/1.1 307 Temporary Redirect');
	header("Location: ../view/php/login.view.php?error=".$_error_);
	exit();
}
else{
    header("Location: ../view/php/home.view.php?");
}
?>