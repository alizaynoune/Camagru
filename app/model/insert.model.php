<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';

function    insert_User($data){
    new Insert($data);
}



?>