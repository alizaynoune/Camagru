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
	  <link class="_css" rel="stylesheet" type="text/css"	href="../css/camera.css"/>

	<!-- <link class="_css" rel="stylesheet" type="text/css"	href="../css/settings.css"/> -->
	</head>
	<body>
	<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/header.view.php';?>
	<div class="content">
		<!-- <h1>camera</h1> -->

		<label class="toggle-control control-stickers">
  				<input name='stickers' id='checkbox-stickers' type="checkbox" checked='true'>
  				<span class="control"></span>
		</label>
		
		<div class="stickers">
			<img src="../stickers/1.png" id="img1" draggable="true" drag="true" />
			<img src="../stickers/2.png" id="img2" draggable="true" />
			<img src="../stickers/3.png" id="img3" draggable="true" />
			<!-- <img src="../stickers/4.png" id="img4" draggable="true" /> -->
		</div>

		<label class="toggle-control control-camera">
  			<input name='camera' id='checkbox-camera' type="checkbox">
  			<span class="control"></span>
		</label>
		
		<!-- action="../../model/NewPost.model.php" -->
		
		 <form  method="POST" enctype="multipart/form-data">
			<h2 class="error"><?= !empty($_GET) && !empty($_GET['error']) ? $_GET['error'] : ''; ?></h2>
			<h2 class="success"><?= !empty($_GET) && !empty($_GET['success']) ? $_GET['success'] : ''; ?></h2>
			<input class="center out-form" type="text" placeholder="title" name="title"/>
			<div class="contener_video">
				<div id='video_id' class="hiddenBtn display">
					<video id="video" class="hiddenBtn display"  autoplay></video>
				</div>
				<button id="capterIn" class="BtnAnim hiddenBtn " type="button"></button>
				<label for="capterIn" class="btncaptuerIn Btn centerBtn display hiddenBtn" onclick="capture_img();">Capture</label>
				<div id='canva_id'>
					<canvas id="canva" ></canvas>
					<canvas id='hiddenCanva'></canvas>
				</div>
				<input type='hidden' name='canva'/>
				<input type='hidden' name='stickers'/>
				<input type='hidden' name='left'/>
				<input type='hidden' name='top'/>
				<input type='hidden' name='width'/>
				<input type='hidden' name='height'/>
				<!-- <input type="hidden" name='InfoStickers'> -->
			</div>
			<div class="buttomBtn">
				<input id='upload' class="BtnAnim" name="Upload" type="file" accept="image/*" onchange="upload_to_canva(event)" />
				<label for="upload" class="btnup Btn leftBtn">Upload</label>
				<button id="capter" class="BtnAnim" type='button'></button>
				<label for="capter" class="btncaptuer Btn centerBtn hiddenBtn display" onclick="capture_img()">Capture</label>				
				<input id="share" class="BtnAnim" type="submit" name="submit" value="share"/>
				<label for="share" class=" btnShr Btn rightBtn">Share</label>
			</div>
			<div class='thumbnails'>
				<div class="post">
					<span class="delet_post"></span>
					<h3 class="title">title test</h3>
					<img src="../../../public/icone/profile.jpg">
					<div class="like_comment">
						<span class="like"></span>
						<h4 class="likeNbr">1c</h4>
						<h4 class="commentNbr">1 comments</h4>
						<div class="comment">
							<span class='delet_commet'>
								<p>commet test</p>
							</span>
						</div>
					</div>
				</div>
			</div>
		</form>





	</div>
	<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/menu.view.php';?>
	<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/footer.view.php'; ?>
	<script type="text/javascript" src="../js/camera.js"></script>
	<script type="text/javascript" src="../../controller/camera.controller.js"></script>
	</body>
</html>