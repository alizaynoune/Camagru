<?php
session_start();
if (!empty($_SESSION) || !empty($_SESSION['login'])){
	header("Location: login.view.php");
}
else if (empty($_POST['login'])){
	session_destroy();
	header("Location: login.view.php");
}
else
	session_destroy();
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/schimaDefine.php';
?>

<!DOCTYPE html>
<html>
	<head>
    <meta charset="UTF-8" />
	<link rel="shortcut icon" type="image/jpg" href="../../../public/icone/logo.jpg">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Camagru</title>
  <link class="_css" rel="stylesheet" type="text/css" href="../css/form.css"/>
	</head>
	<body>
	<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/header.view.php'; ?>

	<div class='Success content'>
	<?php
	echo("<h3>Your account was successfully created! <br><br>Please open your    email and click the activation link to activate your account.
		<br><br>If you do not see your account information in your inbox within 60 seconds please check your spam</h3>");
	?>
		<!-- <h1>Welcome to Camagru</h1>
		<h3>Your account has ben successfully created in order to activate your account. Confirm your email</h3> -->

	</div>

		<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/footer.view.php'; ?>

	</body>
</html>