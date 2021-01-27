<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.php';
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
    <?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/header.php';
        // print_r($_SESSION);
        // echo "done";
    ?>
		<?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/footer.php'; ?>
	</body>
</html>