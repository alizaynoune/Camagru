<?php
if (!isset($_SESSION['USER_NAME'])){
	header("Location: app/view/php/LogIn.php");
	exit;
}

?>
