<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
if ((new Session())->SessionStatus() === false){
    header("Location: home.view.php");
	exit();
}

require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" >
		<link rel="shortcut icon" type="image/jpg" href="../../../public/icone/logo.jpg">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link class="_css" rel="stylesheet" type="text/css" href="../css/headerFooter.css"/>
		<title>Camagru</title>	
	</head>
	<body>
		<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/header.view.php';?>
		<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/menu.view.php';?>
		<div class="content">
			<h1>profile</h1>
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
						<span class='delet_commet'>
							<p>commet test</p>
						</span>
						<span class='delet_commet'>
							<p>commet test</p>
						</span>
						<span class='delet_commet'>
							<p>commet test</p>
						</span>
						<span class='delet_commet'>
							<p>commet test</p>
						</span>
						<span class='delet_commet'>
							<p>commet test</p>
						</span>
					</div>
				</div>
			</div>
		</div>
		<?php @ require $_SERVER['DOCUMENT_ROOT'].'/app/view/php/footer.view.php'; ?>
	</body>
</html>