<?php
session_start();
if (!empty($_SESSION) || !empty($_SESSION['login'])){
	header("Location: profile.view.php");
}
session_destroy();
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/emailActive.model.php';
if (emailactive() === false)
        header("Location: http://".$_SERVER["HTTP_HOST"].'/app/view/php/login.view.php');

?>
<!DOCTYPE html>
<html>
	<head>
    <meta charset="UTF-8" />
	<link rel="shortcut icon" type="image/jpg" href="../../../public/icone/logo.jpg">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Camagru</title>
  <link class="_css" rel="stylesheet" type="text/css" href="../css/login.css"/>
	</head>
	<body>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/header.view.php';
    echo "<h3>Your account was successfully actevite!</h3>";
    require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/footer.view.php';
    ?>
    </body>
</html>