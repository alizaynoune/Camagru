<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/schimaDefine.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/filter.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes.php';

if ((new Session())->SessionStatus() === false){
    header("Location: app/view/php/login.view.php");
	exit();
}

/////// delete account ///////////

else if ($_SERVER['REQUEST_METHOD'] !== 'POST' || $_POST['submit'] !== 'OK'){
	header("Location: ../view/php/login.view.php");
	exit;
}

else if (empty($_POST['login']) || empty($_POST['passwd'])){
    header("Location: ../view/php/settings.view.php");
	exit;
}

else if ($_POST['login'] !== $_SESSION['login']){
    header("Location: ../view/php/delete_account.view.php?error=login does not mach");
	exit;
}


else if (filter_login($_POST['login']) === false || filter_pwd($_POST['passwd']) === false){
    header("Location: ../view/php/delete_account.view.php?error=".$ERROR);
	exit;
}

else if (exist_pwd($_POST['login'], hash('whirlpool', 'ali'.$_POST['passwd'].'zaynoune')) === false){
    header("Location: ../view/php/delete_account.view.php?error=passwd does not mach");
	exit; 
}

else {
	$path =  $_SERVER['DOCUMENT_ROOT'].'/public/usersData/'.$_SESSION['login'];
	(new dbinsert())->drop($DB_DELETE['_drop'], 'Users', 'id', $_SESSION['uid'], $PARAM['int']);
	shell_exec('rm -rf ' . $path);
	(new Session())->logout();
	header("Location:" ._SERVER_ . "/app/view/php/home.view.php");
}

?>