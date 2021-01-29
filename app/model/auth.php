<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/filter.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';

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