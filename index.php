<?php
if (!isset($_SESSION['USER_NAME'])){
	header("Location: view/php/LogIn.php");
	exit;
}
?>