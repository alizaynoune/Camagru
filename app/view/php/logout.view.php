<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
Session::logout();
header("Location: login.view.php");

?>