<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
(new Session())->SessionStatus();
$msg = '';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/emailActive.model.php';
if ($_GET['param'] == 'active'){
  if (emailactive() === false){
    header("Location: http://".$_SERVER["HTTP_HOST"].'/app/view/php/home.view.php');
    exit();
  }
  $msg = '<h3>Your account was successfully actevite!</h3>';
}

else if ($_GET['param'] === 'update' && !empty($_SESSION['login'])){
  if (emailupdate() === false){
    header("Location: http://".$_SERVER["HTTP_HOST"].'/app/view/php/home.view.php');
    exit();
  }
  $msg = '<h3>Your email was successfully update!</h3>';
}

else if ($_GET['param'] === 'pwd' && empty($_SESSION)){
  $get = '';
  $and = '';
  foreach ($_GET as $key => &$value){
    $get = $get . $and. $key . '=' .$value;
    $and = '&';
  }
  header("Location: http://".$_SERVER["HTTP_HOST"].'/app/view/php/newpwd.view.php?'.$get);
  exit();
}

else{
  header("Location: http://".$_SERVER["HTTP_HOST"].'/app/view/php/home.view.php');
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
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/header.view.php';
    echo '<div class="content">';
    echo $msg;
    echo '</div>';
    require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/footer.view.php';
    ?>
    </body>
</html>