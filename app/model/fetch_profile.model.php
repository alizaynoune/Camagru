<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/schimaDefine.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/encrypt_decrypt.model.php';


$lastDate = $_GET['lastdate'];
$login = $_GET['login'];
$id = (new dbselect())->select($DB_SELECT['_login'], 'id', ' Users', $login, $PARAM['str'], 0);

$info = (new dbselect())->fetch_user_post($id['id'], $lastDate);
foreach($info as $key => &$value){
    $uid = $value['uid'];
    $avatar = (new dbselect())->select($DB_SELECT['_uid'], 'url', 'Avatar', $value['uid'], $PARAM['int'], 0);
    foreach($value as $key2 => &$value2){
        if ($key2 === 'id' || $key2 === 'uid'){
            $value2 = encrypt_($value2);
        }
        else if ($key2 === 'url'){
            $value2 =  _SERVER_ . '/public/usersData/' . $login . '/' . $value2;
        }
    }
    $value += array('u_name' => $login);
    $value += array('u_avatar' => _SERVER_ . '/public/usersData/' . $login . '/' . $avatar['url']);
}
exit(json_encode($info));






?>