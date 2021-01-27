<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/filter.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.php';

function    auth($login, $pwd){
    if (exist_login($login) === false || exist_pwd($login, $pwd) === false){
      return(false);
    }
    else {
      $user = new Session();
      return($user->start($login));
    }
    
}

?>