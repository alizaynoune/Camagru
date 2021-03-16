<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';

if ((new Session())->SessionStatus() === false){
    header("Location: login.view.php");
	exit();
}

?>
<!DOCTYPE html>
<html>
	<head>
    <meta charset="UTF-8" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
	<link rel="shortcut icon" type="image/jpg" href="../../../public/icone/logo.jpg">
  <title>Camagru</title>
  <link class="_css" rel="stylesheet" type="text/css" href="../css/headerFooter.css"/>
  <link class="_css" rel="stylesheet" type="text/css" href="../css/form.css"/>
  <link class="_css" rel="stylesheet" type="text/css" href="../css/delet_account.css"/>
	</head>
	<body>
	<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/header.view.php';?>
	<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/menu.view.php';?>

	<div class="content">	
		<div class="form">
			<form action="../../model/delete_account.model.php" method="POST" onkeypress="return event.keyCode != 13;">
                <h1>Delete account</h1>
                <h2 class="error"><?= !empty($_GET) && $_GET['error'] ? $_GET['error'] : ''; ?></h2>
    	        <input class="right" type="text" placeholder="Username" name="login" required/><
                <input class="left Passwd" type="password" placeholder="Password" name="passwd" required/>
				<span class="fa fa-eye-slash" onclick='togglePasswd(this)'></span>
				<input class="submit" name='fack_submit' type="button" value="OK"/>
				<input id='yes_delet' class="BtnAnim" type="submit" name="submit" value="OK" />
			</form>
		</div>
	</div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/footer.view.php'; ?>
	<script type="text/javascript" src="../js/form.js"></script>
	<script type="text/javascript" src="../js/delet_account.js"></script>
    <script type="text/javascript" src="../../controller/validateForm.js"></script>
	</body>
</html>