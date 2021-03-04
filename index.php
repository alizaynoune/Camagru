<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
if ((new Session())->SessionStatus() === false){
    header("Location: app/view/php/login.view.php");
	exit();
}
else{
	header("Location: app/view/php/home.view.php");
	exit();
}
?>
