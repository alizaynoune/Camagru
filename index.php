<?php
session_start();
if (!isset($_SESSION['USER_NAME'])){
	header("Location: app/view/php/login.view.php");
	exit;
}

?>
