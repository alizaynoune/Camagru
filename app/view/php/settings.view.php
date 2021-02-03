<?php
session_start();
if (!isset($_SESSION) || empty($_SESSION['login'])){
	session_destroy();
	header("Location: home.view.php");
}
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/schimaDefine.php';
$usr_info = (new dbselect())->select($DB_SELECT['_id'], 'firstname, lastname, login, email, notif', 'Users', $_SESSION['uid'], $PARAM['int']);
?>
<!DOCTYPE html>
<html>
	<head>
    <meta charset="UTF-8" />
	<link rel="shortcut icon" type="image/jpg" href="../../../public/icone/logo.jpg">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<title>settings</title>
  	<link class="_css" rel="stylesheet" type="text/css" href="../css/login.css"/>
  	<link class="_css" rel="stylesheet" type="text/css" href="../css/settings.css"/>
	</head>
	<body>
		<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/header.view.php';?>
		<div class="content">
			<h1>settings</h1>
			<div class="conten_img">
				<img class="change_avatar" src="<?php get_avatar(); ?>" onclick="show_modal()" />
			</div>
			<form action="../../model/updateinformatio.model.php" method="POST">
				<div class="modal">
					<input class="upload" type="file" id="image" name="img_user" accept="image/*"/>
				  	<label for="image" class="btn-1" accept="image/*">upload</label>
					<input class="camera" type="file" id="camera" name="img_db" />
					<label for="camera" class="btn-2">profile</label>
					<input class="submitImg" id="submitImg" type="submit" name="submit" value="OK"/>
					<label class="cancel" onclick="hedin_modal()">cancel</label>
				</div>
				<div class="form">
						<h1>your information</h1>
						<h2 class="error"><?= !empty($_GET) && $_GET['error'] ? $_GET['error'] : ''; ?></h2>
						<select class="select right" name="notif">
						  <option value="active">notification active</option>
						  <option value="desactive">notification Desactive</option>
						</select>
						<input class="left" type="text" placeholder="First Name" name="firstName" value="<?php echo $usr_info['firstname'];?>"/>
    	        		<input class="right" type="text" placeholder="Last Name" name="lastName" value="<?php echo $usr_info['lastname'];?>"/>
						<input class="left" type="text" placeholder="Username" name="login" value="<?php echo $usr_info['login']?>"/>
						<input class="right" type="email" placeholder="E-mail Address" name="email" value="<?php echo $usr_info['email']?>"/>
						<input class="left" type="password" placeholder="Old Password" name="oldPasswd" />
    	        		<span class="fa fa-eye-slash" onclick='togglePasswd(this)'></span>
    	        		<input class="right" type="password" placeholder="New Password" name="newPasswd" />
    	        		<span class="fa fa-eye-slash" onclick='togglePasswd(this)'></span>
						<input class="left" type="password" placeholder="Confirm Password" name="confnewPasswd" />
    	        		<span class="fa fa-eye-slash" onclick='togglePasswd(this)'></span>
						<input class="submit right" type="submit" name="submit" value="OK"/></br>
					</form>
			</div>
		</div>
		<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/footer.view.php'; ?>
		<script type="text/javascript" src="../../controller/validateForm.js"></script>
		<script type="text/javascript" src="../js/form.js"></script>
		<script type="text/javascript" src="../js/settings.js"></script>
	</body>
</html>