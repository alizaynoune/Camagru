<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';

if ((new Session())->SessionStatus() === true){
    Session::logout();
}
header("Location: login.view.php");


?>