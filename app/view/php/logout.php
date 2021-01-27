<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.php';
Session::logout();
header("Location: logIn.php");

?>