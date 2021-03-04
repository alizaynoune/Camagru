<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/schimaDefine.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/filter.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes.php';

if ((new Session())->SessionStatus() === false){
    header("Location: app/view/php/login.view.php");
	exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || $_POST['submit'] !== 'OK'){
	header("Location: ../view/php/login.view.php");
	exit;
}

if (empty($_POST['login']) || empty($_POST['email']) || empty($_POST['passwd'])){
    header("Location: ../view/php/settings.view.php");
	exit;
}

if ($_POST['login'] !== $_SESSION['login']){
    header("Location: ../view/php/delete_account.view.php?error=login does not mach");
	exit;
}


if (filter_login($_POST['login']) === false || filter_email($_POST['email']) === false || filter_pwd($_POST['passwd']) === false){
    header("Location: ../view/php/delete_account.view.php?error=".$ERROR);
	exit;
}

if (exist_email($_POST['email']) === false){
    header("Location: ../view/php/delete_account.view.php?error=email does not mach");
	exit;
}

$hash_pwd = hash('whirlpool', 'ali'.$_POST['passwd'].'zaynoune');
if (exist_pwd($_POST['login'], $hash_pwd) === false){
    header("Location: ../view/php/delete_account.view.php?error=passwd does not mach");
	exit; 
}

///// delet alll info 
//// logout

echo "all valid </br>";
print_r($_SESSION);
echo "</br>";
print_r($_POST);


?>