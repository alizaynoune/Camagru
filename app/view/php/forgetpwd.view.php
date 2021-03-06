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
  		<title>Camagru</title>
  		<link rel="shortcut icon" type="image/jpg" href="../../../public/icone/logo.jpg">
  		<link class="_css" rel="stylesheet" type="text/css" href="../css/headerFooter.css"/>
  		<link class="_css" rel="stylesheet" type="text/css" href="../css/form.css" />
  		<link class="_css" rel="stylesheet" type="text/css" href="../css/btns.css"/>
	</head>
	<body>
	<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/header.view.php'; ?>
	<div class="container page">	
		<div class="form form-group container">
			<form action="../../model/forgetpwd.model.php" method="POST">
    	        <h1>Recovery Password</h1>
				<h2 class="error"><?= array_key_exists('error', $_GET) ? $_GET['error'] : ''; ?></h2>
				<h2 class="success"><?= !empty($_GET) && $_GET['success'] ? $_GET['success'] : ''; ?></h2>
    	        <input class="left" type="text" placeholder="Username" name="login" required/>
				<input class="right" type="email" placeholder="E-mail" name="email" required/>
				<input class="submit" type="submit" name="submit" value="OK"/>
			</form>
		</div>
		<div class="buttomBtn row justify-content-between">
            <a class="leftBtn Btn col-4 col-sm-4 col-md-3 col-lg-3 col-xl-2" href="login.view.php">SingnIn</a>
            <a class="rightBtn Btn col-4 col-sm-4 col-md-3 col-lg-3 col-xl-2" href="signup.view.php">Create New Account</a>
        </div>
	</div>
		<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/footer.view.php'; ?>
		<script type="text/javascript" src="../../controller/validateForm.js"></script>
		<script type="text/javascript" src="../js/form.js"></script>

	</body>
</html>