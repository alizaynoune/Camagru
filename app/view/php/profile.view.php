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
		<title>Camagru</title>	
	</head>
	<body>
		<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/header.view.php';?>
		<input type="hidden" name="login" value="<?php echo $_SESSION['login'] ?>">
		<div class="content">
			<h1>profile</h1>
		</div>
		<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/menu.view.php';?>
		<?php require $_SERVER['DOCUMENT_ROOT'].'/app/view/php/footer.view.php'; ?>
		<script type="text/javascript" src="../js/Posts.js"></script>
		<script type="text/javascript" src="../js/append_post.js"></script>
		<script type="text/javascript" src="../js/profile.js"></script>
		<!-- <script type="text/javascript" src="../../controller/fetch_profile.controller.js"></script> -->
		<script type="text/javascript" src="../../controller/fetch_data.controller.js"></script>
		<script type="text/javascript" src="../../controller/Posts.controller.js"></script>

	</body>
</html>