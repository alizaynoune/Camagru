<?php
session_start();
if (!isset($_SESSION) || empty($_SESSION['login'])){
    session_destroy();
    header("Location: login.view.php");
}
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
?>
<!DOCTYPE html>
<html>
	<head>
    <meta charset="UTF-8" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="shortcut icon" type="image/jpg" href="../../../public/icone/logo.jpg">
  <title>Camagru</title>
  <link class="_css" rel="stylesheet" type="text/css" href="../css/form.css"/>
	</head>
	<body>
	<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/header.view.php';?>
	<div class="content">	
		<div class="form">
			<form action="../../model/delete_account.model.php" method="POST">
                <h1>Delete account</h1>
                <h2 class="error"><?= !empty($_GET) && $_GET['error'] ? $_GET['error'] : ''; ?></h2>
    	        <input class="left" type="text" placeholder="Username" name="login" required/></br>
                <input class="right" type="email" placeholder="E-mail" name="email" required/></br>
                <input class="left Passwd" type="password" placeholder="Password" name="passwd" required/>
				<span class="fa fa-eye-slash" onclick='togglePasswd(this)'></span></br>
				<input class="submit right" type="submit" name="submit" value="OK"/></br>
			</form>
		</div>
	</div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/footer.view.php'; ?>
    <script type="text/javascript" src="../js/form.js"></script>
    <!-- <script type="text/javascript" src="../../controller/validateForm.js"></script> -->
	</body>
</html>