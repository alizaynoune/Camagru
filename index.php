<?php
session_start();
if (empty($_SESSION['login'])){
	session_destroy ();
	header("Location: app/view/php/login.view.php");
	exit;
}

else
	header("Location: app/view/php/home.view.php");
print_r($_SESSION);
?>
