<?php
session_start();
if ($_SESSION['login'])
	header("Location: home.php?");
?>

<!DOCTYPE html>
<html>
	<head>
    <meta charset="UTF-8" />
  <title>Camagru</title>
  <link class="_css" rel="stylesheet" type="text/css" href="../css/login.css" />
	</head>
	<body>
    <?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/header.php'; ?>
        <div class="form">
		<form action="login.php" method="POST">
            <h1>Recovery Password</h1>
            <input class="left" type="text" placeholder="Username" name="login" required/></br>
			<input class="right" type="email" placeholder="E-mail" name="email" required/></br>
			<input class="submit left" type="submit" name="submit" value="OK"/></br>
		</form>
		</div>
		<div class="buttomBtn">
			<a class="leftBtn" href="SignUp.php"><p>Create New Account</p></a>
			<a class="rightBtn" href="LogIn.php"><p>SignIn</p></a>
		</div>
		<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/footer.php'; ?>
		<script type="text/javascript" src="../../controller/validateForm.js"></script>
		<script type="text/javascript" src="../js/form.js"></script>

	</body>
</html>