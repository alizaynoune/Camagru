<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
(new Session())->SessionStatus();
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
	  <link class="_css" rel="stylesheet" type="text/css" href="../css/Posts.css"/>
	  <!-- <link class="_css" rel="stylesheet" type="text/css" href="../css/form.css"/> -->
	</head>
	<body>
	<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/header.view.php';?>
	<div class="content">
		<h1>home</h1>

		<div class="post">
			<span class="delet_post"></span>
			<input type='hidden' name='post_info'/>
			<div class="info">
				<img id="img_owner" src="../../../public/icone/profile.jpg">
				<h4 class="owner">name of owner</h4>
				<h2 class="title">title test</h2>
			</div>
			<img id='img_post' src="../../../public/icone/profile.jpg">
			<div class="comment_like">
				<div class="contener_like">
					<label class="like"></label>
					<span>20</span>
					<h4 class="commentNbr" onclick="toggle_comments(this.parentNode.parentNode)">10 comments</h4>
				</div>
				<div class="contener_comment">	
					<div class="comment hidden">
					<div class="old_comment">
							<input type='hidden' name='comment_info'/>
							<label class="like"></label>
							<span>20</span>
							<h4> owner_of_comment</h4>
							<span class='delet_comment'></span>
							<p>comment comment commet libxml_set_external_entity_loader for test</p>
							<p>10-25-2021</p>
						</div>
					</div>
					<div class="new_comment">
						<input type="text" name="comment" placeholder="add comment" />
						<div>
							<input id="submit_comment" type="submit" name="submit" value="comment"/>
							<label id='submit' for="submit_comment" ></label>
						</div>
					</div>
				</div>
			</div>
		</div>







	</div>
	<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/menu.view.php';?>

	<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/footer.view.php'; ?>

	<script type="text/javascript" src="../js/Posts.js"></script>
	<!-- <script type="text/javascript" src="../../controller/camera.controller.js"></script> -->
	</body>
</html>