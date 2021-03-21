<?php
session_start();
if (!isset($_SESSION) || empty($_SESSION['login'])){
	session_destroy();
	header("Location: home.view.php");
 if (!array_key_exists('error', $_GET))
	$_GET['error'] = '';
}
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/schimaDefine.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/encrypt_decrypt.model.php';


$usr_info = (new dbselect())->select($DB_SELECT['_id'], 'firstname, lastname, login, email, notif', 'Users', $_SESSION['uid'], $PARAM['int'], 0);
?>
<!DOCTYPE html>
<html>
	<head>
    <meta charset="UTF-8" />
	<link rel="shortcut icon" type="image/jpg" href="../../../public/icone/logo.jpg">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
	  <title>settings</title>
	  <link class="_css" rel="stylesheet" type="text/css" href="../css/headerFooter.css"/>
	  <link class="_css" rel="stylesheet" type="text/css" href="../css/form.css"/>
	  <link class="_css" rel="stylesheet" type="text/css" href="../css/settings.css"/>
	  <link class="_css" rel="stylesheet" type="text/css" href="../css/btns.css"/>
	  <link class="_css" rel="stylesheet" type="text/css" href="../css/Posts.css"/>
	  <style>
	  	.list li:nth-child(4){
			  color: #F08080;			  
		  }
	  </style>
	</head>
	<body>
		<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/header.view.php';?>
		<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/menu.view.php';?>

		<div class="container">
			
			<!-- <h1>settings</h1> -->
			<div class="form">
				<div class="conten_img">
					<img class="change_avatar" onclick="show_modal()" />
				</div>
				<form action="../../model/updateinformatio.model.php" method="POST" enctype="multipart/form-data">
					<div class="card modal-show hidden">
						<div class="card-body">
							<input class="upload BtnAnim" type="file" id="image" name="img_user" accept="image/*" onchange="load_img(event)" />
							<input class="camera BtnAnim" type="text" id="camera" name="img_db"/>
							<img id="src_avatar"/>
							<div class="row Btn_modal">
								<div class="col">
									<label for="camera" class="btn-2 Btn row" onclick="img_from_profile()">profile</label>
									<label for="image" class="btn-1  Btn row ">upload</label>
								</div>
								<div class="col left_col">
									<div class="row justify-content-end">
										<label class="cancel  Btn row" onclick="hidden_modal()">cancel</label>
									</div>
									<div class="row justify-content-end">
										<label class="ok Btn row" onclick="valid_img()">OK</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<h3 class="msj_new_av"></h3>
		  
					<h1>your information</h1>
					<h2 class="error"><?= array_key_exists('error', $_GET) ? $_GET['error'] : ''; ?></h2>
					<h2 class="success"><?= !empty($_GET) && $_GET['success'] ? $_GET['success'] : ''; ?></h2>
					<select class="select right" name="notif">
					  <option value="<?php echo $usr_info['notif'] ?>"><?php echo $usr_info['notif'] === 'true'? 'active notification' :'Desactive notification' ; ?></option>
					  <option value="<?php echo $usr_info['notif'] === 'true'?'false':'true'; ?>"><?php echo $usr_info['notif'] === 'true'? 'Desactive notification' : 'active notification' ; ?></option>
					</select>
					<input class="left" type="text" placeholder="First Name" name="firstName" value="<?php echo $usr_info['firstname'];?>"/>
    	    	    <input class="right" type="text" placeholder="Last Name" name="lastName" value="<?php echo $usr_info['lastname'];?>"/>
					<input class="left" type="text" placeholder="Username" name="login" value="<?php echo $usr_info['login']?>"/>
					<input class="right" type="email" placeholder="E-mail Address" name="email" value="<?php echo $usr_info['email']?>"/>
					<input class="left" type="password" placeholder="Old Password" name="oldPasswd" />
    	    	    <span class="fa fa-eye-slash icon_left" onclick='togglePasswd(this.previousElementSibling, this)'></span>
					<span class="fa fa-eye-slash icon_right" onclick='togglePasswd(this.nextElementSibling , this)'></span>
					<input class="right" type="password" placeholder="New Password" name="newPasswd" />
		  
					<input class="left" type="password" placeholder="Confirm Password" name="confnewPasswd" />
    	    	    <span class="fa fa-eye-slash icon_left" onclick='togglePasswd(this.previousElementSibling, this)'></span>
					<input class="submit" type="submit" name="submit" value="Submit"/>
				</form>
			</div>
			<div class="delete">
				<a class="button" href="delete_account.view.php"><p>delet account!</p></a>
			</div>
		</div>
		<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/footer.view.php'; ?>
		<script type="text/javascript" src="../../controller/validateForm.js"></script>
		<script type="text/javascript" src="../js/form.js"></script>
		<script type="text/javascript" src="../js/settings.js"></script>
		<script type="text/javascript" src="../../controller/fetch_data.controller.js"></script>
		<script type="text/javascript" src="../js/append_post.js"></script>


		<!-- <script type="text/javascript" src="../js/Posts.js"></script> -->
		<!-- <script type="text/javascript" src="../js/append_post.js"></script> -->
		<!-- <script type="text/javascript" src="../js/profile.js"></script> -->
		<!-- <script type="text/javascript" src="../../controller/fetch_profile.controller.js"></script> -->
		<!-- <script type="text/javascript" src="../../controller/fetch_data.controller.js"></script> -->
		<!-- <script type="text/javascript" src="../../controller/Posts.controller.js"></script> -->
	</body>
</html>