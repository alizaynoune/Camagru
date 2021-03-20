<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
if ((new Session())->SessionStatus() === true){
    header("Location: home.view.php");
	exit();
}
	
?>

<!DOCTYPE html>
<html>
	<head>
    <meta charset="UTF-8" />
	<link rel="shortcut icon" type="image/jpg" href="../../../public/icone/logo.jpg">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Camagru</title>
  <link class="_css" rel="stylesheet" type="text/css" href="../css/headerFooter.css" />
  <link class="_css" rel="stylesheet" type="text/css" href="../css/form.css"/>
  <link class="_css" rel="stylesheet" type="text/css" href="../css/btns.css"/>
	</head>
	<body>
		<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/header.view.php';?>
		<div class="container">
    	    <div class="form form-group container">
				<form action="../../model/login.model.php" method="POST">
					<h1>Sign In</h1>
					<h2 class="error"><?= !empty($_GET) && $_GET['error'] ? $_GET['error'] : ''; ?></h2>
					<h2 class="success"><?= !empty($_GET) && $_GET['success'] ? $_GET['success'] : ''; ?></h2>
					<input class="left" type="text" placeholder="Username" name="login" value="<?= !empty($_POST) && $_POST["login"] ? $_POST["login"] : "";?>" required/></br>
					<span class="fa fa-eye-slash icon_right" onclick='togglePasswd(this.nextElementSibling, this)'></span>
					<input class="right Passwd" type="password" placeholder="Password" name="passwd" required/>
					<input class="submit" type="submit" name="submit" value="OK"/>
				</form>
			</div>
			<div class="buttomBtn row justify-content-between">
				<a class="leftBtn Btn col-4 col-sm-4 col-md-3 col-lg-3 col-xl-2" href="signup.view.php">Create New Account</a>
				<a class="rightBtn Btn col-4 col-sm-4 col-md-3 col-lg-3 col-xl-2" href="forgetpwd.view.php">Forgotten password?</a>
			</div>
		</div>
		<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/footer.view.php'; ?>
		<script type="text/javascript" src="../../controller/validateForm.js"></script>
		<script type="text/javascript" src="../js/form.js"></script>
	</body>
</html>