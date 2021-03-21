<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';

if ((new Session())->SessionStatus() === false){
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

	  <title>Camagru</title>
	  <link class="_css" rel="stylesheet" type="text/css" href="../css/headerFooter.css"/>
	  <link class="_css" rel="stylesheet" type="text/css" href="../css/form.css"/>
	  <link class="_css" rel="stylesheet" type="text/css" href="../css/btns.css"/>
	  
	  <link class="_css" rel="stylesheet" type="text/css"	href="../css/Posts.css"/>
	<link class="_css" rel="stylesheet" type="text/css"	href="../css/camera.css"/>
	<!-- <link class="_css" rel="stylesheet" type="text/css"	href="../css/settings.css"/> -->
	<style>
	  	.list li:nth-child(1){
			  color: #F08080;			  
		  }
	  </style>
	</head>
	<body>
		<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/header.view.php';?>
		<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/menu.view.php';?>

		<div class="container-fluid">
			<div class="stickers container col col-xs-4 col-sm-12 col-md-12">
				<img src="../stickers/1.png" id="img1" draggable="true" drag="true" />
				<img src="../stickers/2.png" id="img2" draggable="true" />
				<img src="../stickers/3.png" id="img3" draggable="true" />
			</div>
			<div class="container-controls container row">
				<label class="toggle-control control-camera col">
  					<input name='camera' id='checkbox-camera' type="checkbox">
  					<span class="control"></span>
				</label>
				<label class="toggle-control control-stickers col">
  						<input name='stickers' id='checkbox-stickers' type="checkbox" checked='true'>
  						<span class="control"></span>
				</label>
			</div>
			<div class="form form-group container row">
				 <form  method="POST" enctype="multipart/form-data">
					<h2 class="error col text-sm-left"><?= !empty($_GET) && !empty($_GET['error']) ? $_GET['error'] : ''; ?></h2>
					<h2 class="success col text-sm-left"><?= !empty($_GET) && !empty($_GET['success']) ? $_GET['success'] : ''; ?></h2>
					<input class="out-form " type="text" placeholder="title" name="title"/>								
					<input type='hidden' name='canva'/>
					<input type='hidden' name='stickers'/>
					<input type='hidden' name='left'/>
					<input type='hidden' name='top'/>
					<input type='hidden' name='width'/>
					<input type='hidden' name='height'/>
					<input id="share" class="BtnAnim" type="submit" name="submit" value="share"/>
				</form>
			</div>
			<div class="contener_camera row justify-content-center">
				<div class="contener_video row " id="contener_video">
					<div id='video_id' class="hiddenBtn display col-12 col-sm-11 col-md-9 col-lg-5 col-xl-3">
						<video id="video" class="hiddenBtn display"  autoplay></video>
						<button id="capter" class="BtnAnim hiddenBtn " type="button" onclick="capture_img();"></button>
						<label for="capter" class="btncaptuerIn Btn  display hiddenBtn col-4 col-sm-4 col-md-3 col-lg-4 col-xl-4" >Capture</label>
					</div>
					<div id='canva_id' class="col-12 col-sm-11 col-md-9 col-lg-5 col-xl-3">
						<canvas id="canva" ></canvas>
						<canvas id='hiddenCanva' style="width: 400px; height: 200px;"></canvas>
					</div>
				</div>
			</div>
			<div class="buttomBtn row justify-content-between">
				<input id='upload' class="BtnAnim" name="Upload" type="file" accept="image/*" onchange="upload_to_canva(event)" />
				<label for="upload" class="btnup Btn leftBtn col-4 col-sm-3 col-md-3 col-lg-2 col-xl-2">Upload</label>
				<label for="capter" class="btncaptuer Btn  hiddenBtn display col-4 col-sm-3 col-md-3 col-lg-2 col-xl-2">Capture</label>
				<label for="share" class=" btnShr Btn rightBtn col-4 col-sm-3 col-md-3 col-lg-2 col-xl-2">Share</label>
			</div>
			<div class='thumbnails'>
			</div>
		</div>
		<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/footer.view.php'; ?>
		<script type="text/javascript" src="../js/camera.js"></script>
		<script type="text/javascript" src="../../controller/camera.controller.js"></script>
		<script type="text/javascript" src="../js/Posts.js"></script>
		<script type="text/javascript" src="../js/append_post.js"></script>
		<script type="text/javascript" src="../../controller/Posts.controller.js"></script>
		<script type="text/javascript" src="../../controller/fetch_data.controller.js"></script>  
	</body>
</html>