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
		
		</div>
		<?php @ require $_SERVER['DOCUMENT_ROOT'].'/app/view/php/footer.view.php'; ?>
	</body>
</html>