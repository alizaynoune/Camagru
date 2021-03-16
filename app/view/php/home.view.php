<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/includes.php';
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
	  <style>
	  	.list li:nth-child(3){
			  color: #F08080;			  
		  }
	  </style>
	</head>
	<body>
	<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/header.view.php';?>
	<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/menu.view.php';?>

	
	<div class="content">
		<h1>home</h1>




	</div>

	<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/footer.view.php'; ?>
	<script type="text/javascript" src="../js/Posts.js"></script>
		<script type="text/javascript" src="../js/append_post.js"></script>
		<script type="text/javascript" src="../js/home.js"></script>
		<script type="text/javascript" src="../../controller/fetch_data.controller.js"></script>
		<script type="text/javascript" src="../../controller/Posts.controller.js"></script>
	</body>
</html>