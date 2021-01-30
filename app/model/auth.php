<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/filter.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes.php';

function    auth($login, $pwd){
  global $ERROR;
    if (exist_login($login) === false){
      $ERROR = 'login invalide';
      return(false);
    }
    if (exist_pwd($login, $pwd) === false){
      $ERROR = 'passowrd invalide';
      return(false);
    }
    else {
      $user = new Session();
      return($user->start($login));
    }
    
}

?>