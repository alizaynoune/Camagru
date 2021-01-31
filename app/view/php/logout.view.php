<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
session_start();
if (!empty($_SESSION) && !empty($_SESSION['login']))
    Session::logout();
else
    session_destroy();
header("Location: login.view.php");

?>