<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/schimaDefine.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/encrypt_decrypt.model.php';



if ((new Session())->SessionStatus() === false){
    header("Location: ../view/php/login.view.php");
	exit();
}

$info = (new dbselect())->select($DB_SELECT['_uid'], '*', 'Posts', decrypt_($_SESSION['uid']), $PARAM['int'], 1);
foreach($info as $key => &$value){
    foreach($value as $key2 => &$value2){
        if ($key2 === 'id' || $key2 === 'uid'){
            $value2 = encrypt_($value2);
        }
    }
}
exit(json_encode($info));






?>