<?php
// header('Content-Type: image/jpeg');
// require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/schimaDefine.php';
// require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';

// session_start();
// if (empty($_SESSION) || empty($_SESSION['login'])){
// 	session_destroy();
// 	header("Location: ../../index.php");
// }

echo $_POST['img'];
print_r($_POST);
// getimagesize($_FILES["fileToUpload"]["tmp_name"]);

// imagejpeg($_POST['img']);
?>