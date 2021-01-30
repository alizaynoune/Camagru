<?php
session_start();
if ($_SESSION && $_SESSION['login'])
	header("Location: home.view.php?");
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/schimaDefine.php';
?>

<!DOCTYPE html>
<html>
	<head>
    <meta charset="UTF-8" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Camagru</title>
  <link class="_css" rel="stylesheet" type="text/css" href="../css/login.css"/>
	</head>
	<body>
	<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/header.view.php'; ?>


		<?php
		require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
		$rslt = (new dbselect())->select($DB_SELECT['_email'], 'login, id', 'Users', 'ali@ali.com', $PARAM['int']);
		print_r($rslt);
		echo "done";
		?>

		<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/footer.view.php'; ?>

	</body>
</html>