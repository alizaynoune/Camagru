<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';

if ((new Session())->SessionStatus() === false){
    header("Location: ../view/php/login.view.php");
	exit();
}


print_r($_POST);
// print_r($_SERVER);
// print_r($_FILES);
// echo '</br>';
// print_r($_FILES);
// print_r(testCanvas.toDataURL("image/png"));


// header("Content-type: image/png");
// $data = "/9j/4AAQSkZJRgABAQEAYABgAAD........";
// echo '<img src="'.$_POST['canva'].'"/>';
// imagedestroy($_POST['canva']);



?>