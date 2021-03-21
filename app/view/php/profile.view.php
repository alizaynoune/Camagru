<?php

// require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/schimaDefine.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/encrypt_decrypt.model.php';
// test get data////////////


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
		<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
		<link class="_css" rel="stylesheet" type="text/css"	href="../css/Posts.css"/>
		<link class="_css" rel="stylesheet" type="text/css" href="../css/headerFooter.css"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Camagru</title>
		<style>
	  	.list li:nth-child(2){
			  color: #F08080;			  
		  }
	  </style>
	</head>
	<body>
		<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/header.view.php';?>
				<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/menu.view.php';?>

		<input type="hidden" name="login" value="<?php echo $_SESSION['login'] ?>">
		<div class="row justify-content-around page">

		<div class="post  col-11 col-sm-11 col-md-10 col-lg-5 col-xl-5">
			<input type="hidden" name="post_info" value="jv8f_leet_iw==">
			<div class="info row card-header">
				<!-- <div class="col"> -->
					<img class="img_owner row" src="http://localhost:8000/public/usersData/ali-zaynoune/avatar.jpg">
					<h4 class="owner col">ali-zaynoune</h4>
				<!-- </div> -->
				
				<div class="col-2">
					<span class="delet_post row justify-content-end"></span>
					<p class="row">3/21/2021, 14:50:11</p>
				</div>
				<h4 class="title col-12">fdsadf</h4>
			</div>
			<img class="img_post card-img" src="http://localhost:8000/public/usersData/ali-zaynoune/avatar.jpg">
			<div class="comment_like card-body col">
				<div class="contener_like row justify-content-between">
					<label class="dislike">0</label>
					<h3 class="feedback">feedback</h3>
					<label class="commentNbr">0</label>
				</div>
				<div class="contener_comment row">
					<div class="comment col-12">
						<div class="old_comment row">
							<input type="hidden" name="comment_info" value="jf8W_leet_jPg=_leet_iw==">
							<label class="dislike col-2">0</label>
							<h4 class="col">ali-zaynoune</h4>
							<p class="col">2021-03-15 18:22:52</p>
							<span class="delet_comment col-1"></span>
							<p class="col-12">test notif comment to email</p>
						</div>
					</div>
					<!-- <div class="col"> -->
					<form method="POST row">
						<div class="new_comment">
							<input type="text" name="comment" placeholder="add comment">
							<input id="8rywzu18sy" type="submit" name="submit" value="comment">
							<label for="8rywzu18sy" ></label>
						</div>
						<!-- </div> -->
					</form>
				</div>
			</div>
		</div>

		<div class="post card col-12 col-sm-12 col-md-10 col-lg-5 col-xl-5">
			<input type="hidden" name="post_info" value="jv8f_leet_iw==">
			<div class="info row card-header">
				<div class="col-2">
					<img class="img_owner row" src="http://localhost:8000/public/usersData/ali-zaynoune/avatar.jpg">
					<h4 class="owner row">ali-zaynoune</h4>
				</div>
				<h4 class="title col">fdsadf</h4>
				<div class="col-2">
					<span class="delet_post row"></span>
					<p class="row">3/21/2021, 14:50:11</p>
				</div>
			</div>
			<img class="img_post card-img" src="http://localhost:8000/public/usersData/ali-zaynoune/avatar.jpg">
			<div class="comment_like card-body">
				<div class="contener_like row justify-content-between">
					<label class="dislike">0</label>
					<h3 class="feedback">feedback</h3>
					<label class="commentNbr">0</label>
				</div>
				<div class="contener_comment">
					<div class="comment hidden"></div>
					<form method="POST">
						<div class="new_comment">
							<input type="text" name="comment" placeholder="add comment">
							<input id="8rywzu18sy" type="submit" name="submit" value="comment">
							<label for="8rywzu18sy" ></label>
						</div>
					</form>
				</div>
			</div>
		</div>
		</div>
		<?php require $_SERVER['DOCUMENT_ROOT'].'/app/view/php/footer.view.php'; ?>
		<script type="text/javascript" src="../js/Posts.js"></script>
		<script type="text/javascript" src="../js/append_post.js"></script>
		<script type="text/javascript" src="../js/profile.js"></script>
		<!-- <script type="text/javascript" src="../../controller/fetch_profile.controller.js"></script> -->
		<script type="text/javascript" src="../../controller/fetch_data.controller.js"></script>
		<script type="text/javascript" src="../../controller/Posts.controller.js"></script>

	</body>
</html>