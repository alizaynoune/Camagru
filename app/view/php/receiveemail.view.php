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