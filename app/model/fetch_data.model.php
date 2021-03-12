<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/schimaDefine.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/encrypt_decrypt.model.php';


$lastDate = $_GET['lastdate'];

if ($_GET['type'] === 'all'){
    $info = (new dbselect())->fetch_all_post($lastDate);
    foreach($info as $key => &$value){
        $uid = $value['uid'];
        $user_name = (new dbselect())->select($DB_SELECT['_id'], 'login', 'Users', $value['uid'], $PARAM['int'], 0);
        $avatar = (new dbselect())->select($DB_SELECT['_uid'], 'url', 'Avatar', $value['uid'], $PARAM['int'], 0);
        foreach($value as $key2 => &$value2){
            if ($key2 === 'id' || $key2 === 'uid'){
                $value2 = encrypt_($value2);
            }
            else if ($key2 === 'url'){
                $value2 =  _SERVER_ . '/public/usersData/' . $user_name['login'] . '/' . $value2;
            }
        }
        $value += array('u_name' => $user_name['login']);
        $value += array('u_avatar' => _SERVER_ . '/public/usersData/' . $user_name['login'] . '/' . $avatar['url']);
    }
    exit(json_encode($info));
}

else if ($_GET['type'] === 'profile'){
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
}

else if ($_GET['type'] === 'comment'){
    // print($_GET['pid']);
    $pid = decrypt_($_GET['pid']);
    $info = (new dbselect())->fetch_comment($pid);
    foreach($info as $key => &$value){
        foreach($value as $key2 => &$value2){
            if ($key2 === 'uid'){
                $login = (new dbselect())->select($DB_SELECT['_id'], 'login', ' Users', $value['uid'], $PARAM['int'], 0);
                $value['owner'] = $login['login'];
            }

        }
        $value['uid'] = encrypt_($value['uid']);
        $value['id'] = encrypt_($value['id']);
        $value['pid'] = encrypt_($value['pid']);
    }
    exit(json_encode($info));
}

// else if ()


?>