<?php
session_start();
// require_once $_SERVER['DOCUMENT_ROOT'].'/includes.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
?>
<!DOCTYPE html>
<html>
	<head>
    <meta charset="UTF-8" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="shortcut icon" type="image/jpg" href="../../../public/icone/logo.jpg">
  <title>Camagru</title>
  <link class="_css" rel="stylesheet" type="text/css" href="../css/login.css"/>
	</head>
	<body>
    <?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/header.view.php';?>
	<h1>home</h1>
	<?php
	// print_r($_SERVER);
	// echo $_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/includes.php';

	?>
		<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/footer.view.php'; ?>
	</body>
</html>