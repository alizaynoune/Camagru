<?php
session_start();
if (empty($_SESSION) || empty($_SESSION['login'])){
	session_destroy();
	header("Location: home.view.php");
}
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
?>
<!DOCTYPE html>
<html>
	<head>
    <meta charset="UTF-8" />

	<link rel="shortcut icon" type="image/jpg" href="../../../public/icone/logo.jpg">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  <title>Camagru</title>
	  <link class="_css" rel="stylesheet" type="text/css" href="../css/headerFooter.css"/>
	  <link class="_css" rel="stylesheet" type="text/css" href="../css/form.css"/>
	  <link class="_css" rel="stylesheet" type="text/css" href="../css/btns.css"/>
	  <link class="_css" rel="stylesheet" type="text/css"	href="../css/camera.css"/>

	<!-- <link class="_css" rel="stylesheet" type="text/css"	href="../css/settings.css"/> -->
	</head>
	<body>
	<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/header.view.php';?>
	<div class="content">
		<h1>camera</h1>

		<!-- <div class="emoji">
			<p>&#129409;</p>
		</div>
		<video id="video" autoplay></video>
		<canva id="canva"></canva> -->
		<div class="stickers">
			<!-- <h2>tse</h2> -->
		</div>

		<label class="toggle-control control-camera">
  			<input type="checkbox" onclick="control_camera(this)">
  			<span class="control"></span>
		</label>
		<form action="#" method="POST" enctype="multipart/form-data">
			<h2 class="error"><?= !empty($_GET) && $_GET['error'] ? $_GET['error'] : ''; ?></h2>
			<h2 class="success"><?= !empty($_GET) && $_GET['success'] ? $_GET['success'] : ''; ?></h2>
			<!-- <select class="select right" name="notif">
			  <option value="emoji1">emoji1</option>
			  <option value="emoji2">emoji2</option>
			  	<input class="camera" type="file" id="camera" name="img_db" accept="image/*"/>
					<label for="camera" class="btn-2">profile</label>
			</select> -->
			<div class="div_video">
				<video id="video" autoplay></video>
				<canvas id="canva"></canvas>
			</div>
			<div class="buttomBtn">
				<input id='upload' class="BtnAnim" name="Upload" type="file" accept="image/*"/>
				<label for="upload" class="btnup Btn leftBtn">Upload</label>
				
				<input id="capter" class="BtnAnim" name="Capture"/>
				<label for="capter" class="btncaptuer Btn centerBtn">Capture</label>

				
				
				<input id="share" class="BtnAnim" type="submit" name="submit"/>
				<label for="share" class=" btnShr Btn rightBtn">Share</label>
			</div>
		</form>





	</div>
	<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/footer.view.php'; ?>
	<script type="text/javascript" src="../js/camera.js"></script>
	</body>
</html>