<?php
/////////////////////valid login and password////////////////////
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/schimaDefine.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
if ((new Session())->SessionStatus() === true){
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
	</head>
	<body>
	<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/header.view.php'; ?>
	<div class='Success container'>
	<h3>Your account was successfully created!</h3>
	<p> open your    email and click the activation link to activate your account.
	If you do not see your account information in your inbox within 60 seconds please check your spam</p>
	</div>

		<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/footer.view.php'; ?>

	</body>
</html>