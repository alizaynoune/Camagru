<?php
include 'auth.php';
function    filter_inputs(){
    return(ture);

}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || $_POST['submit'] !== 'OK' || filter_inputs() === false || auth($_POST['login'], $_POST['passwd']) === false){
    header('HTTP/1.1 307 Temporary Redirect');
	header("Location: ../view/php/LogIn.php");
	exit();
}

print_r($_POST);


?>