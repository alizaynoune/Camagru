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
	<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/menu.view.php';?>
	<div class="content">
		<h1>home</h1>


		<div class="post">
			<h2 class=""
			<span class="delet_post"></span>
			<h3 class="title">title test</h3>
			<img src="../../../public/icone/profile.jpg">
			<div class="comment_like">
				<div class="contener_like">
					<span class="like"></span>
					<h4 class="likeNbr">1likes</h4>
				</div>
				<div class="new_comment">
						<input type="text" name="comment" placeholder="add comment" />
						<input type="submit" name="submit" value="comment"/>
				</div>
				<div class="contener_comment">
						<h4 class="commentNbr">10 comments</h4>
						<div class="comment">
							<div class="old_comment">
								<span class='delet_comment'></span>
								<p>comment for test</p>
							</div>
							<div class="old_comment">
								<span class='delet_comment'></span>
								<p>comment for sjfdljkdsfljkdlskfjklsdjfljks;l test</p>
							</div>
							<div class="old_comment">
								<span class='delet_comment'></span>
								<p>comment for test</p>
							</div>
							<div class="old_comment">
								<span class='delet_comment'></span>
								<p>comment for test</p>
							</div>
							<div class="old_comment">
								<span class='delet_comment'></span>
								<p>comment for test</p>
							</div>
							<div class="old_comment">
								<span class='delet_comment'></span>
								<p>comment for test</p>
							</div>
							<div class="old_comment">
								<span class='delet_comment'></span>
								<p>comment for test</p>
							</div>
							<div class="old_comment">
								<span class='delet_comment'></span>
								<p>comment for test</p>
							</div>
							<div class="old_comment">
								<span class='delet_comment'></span>
								<p>comment for test</p>
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
	<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/footer.view.php'; ?>
	</body>
</html>