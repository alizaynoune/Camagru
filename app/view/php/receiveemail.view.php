<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
(new Session())->SessionStatus();
$msg = '';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/emailActive.model.php';
if ($_GET['param'] == 'active'){
  if (emailactive() === false){
    header("Location: http://".$_SERVER["HTTP_HOST"].'/app/view/php/signup.view.php?error=invalid token');
    exit();
  }
  header("Location: http://".$_SERVER["HTTP_HOST"].'/app/view/php/login.view.php?success=Your account was successfully actevite!');
  exit();
}

else if ($_GET['param'] === 'update'){
  if (emailupdate() === false){
    if (!empty($_SESSION['login'])){
      header("Location: http://".$_SERVER["HTTP_HOST"].'/app/view/php/settings.view.php?error=invalid token');
      exit();
    }
    else{
      header("Location: http://".$_SERVER["HTTP_HOST"].'/app/view/php/singup.view.php?error=invalid token');
      exit();
    }
  }
  header("Location: http://".$_SERVER["HTTP_HOST"].'/app/view/php/settings.view.php?success=Your email was successfully update!');
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