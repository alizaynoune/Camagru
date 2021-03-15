<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/schimaDefine.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/encrypt_decrypt.model.php';

(new Session())->SessionStatus();



if ($_GET['type'] === 'all'){
    $lastDate = $_GET['lastdate'];
    $info = (new dbselect())->fetch_all_post($lastDate);
    // print_r($info);
    foreach($info as $key => &$value){
        $uid = $value['uid'];
        // echo $uid;
        $user_name = (new dbselect())->select($DB_SELECT['_id'], 'login', 'Users', $value['uid'], $PARAM['int'], 0);
        $avatar = (new dbselect())->select($DB_SELECT['_uid'], 'url', 'Avatar', $value['uid'], $PARAM['int'], 0);
        // print_r($_SESSION);
        if (!empty($_SESSION['uid'])){
            $is_like = (new dbselect())->is_like_post($_SESSION['uid'], $value['id']);
            $value['is_like'] = !empty($is_like) ? '1' : '0';
            
        }
        else{
            $value['is_like'] = '0';
        }
        $value['id'] = encrypt_($value['id']);
        $value['uid'] = encrypt_($value['uid']);
        $value['url'] = _SERVER_ . '/public/usersData/' . $user_name['login'] . '/' . $value['url'];
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
        if (!empty($_SESSION['uid'])){
            $is_like = (new dbselect())->is_like_post($_SESSION['uid'], $value['id']);
            $value['is_like'] = !empty($is_like) ? '1' : '0';
            
        }
        else{
            $value['is_like'] = '0';
        }
        $value['id'] = encrypt_($value['id']);
        $value['uid'] = encrypt_($value['uid']);
        $value['url'] = _SERVER_ . '/public/usersData/' . $login . '/' . $value['url'];
        $value += array('u_name' => $login);
        $value += array('u_avatar' => _SERVER_ . '/public/usersData/' . $login . '/' . $avatar['url']);
    }
    exit(json_encode($info));
}

else if ($_GET['type'] === 'comment'){
    $pid = decrypt_($_GET['pid']);
    $info = (new dbselect())->fetch_comment($pid);
    foreach($info as $key => &$value){
        $login = (new dbselect())->select($DB_SELECT['_id'], 'login', ' Users', $value['uid'], $PARAM['int'], 0);
        $value['owner'] = $login['login'];
        if (!empty($_SESSION['uid'])){
            $is_like = (new dbselect())->is_like_comment($_SESSION['uid'], $value['id']);
            $value['is_like'] = !empty($is_like) ? '1' : '0';
        }
        else{
            $value['is_like'] = '0';
        }
        $value['uid'] = encrypt_($value['uid']);
        $value['id'] = encrypt_($value['id']);
        $value['pid'] = encrypt_($value['pid']);
    }
    exit(json_encode($info));
}

else if ($_GET['type'] === 'profil_login'){
    if (empty($_SESSION['uid'])){
        exit(json_encode(false));
    }
    else{
        $lastDate = $_GET['lastdate'];
        $info = (new dbselect())->fetch_user_post($_SESSION['uid'], $lastDate);
        $data = [];
        foreach($info as $key => $value){
            $data[$key]['id'] = encrypt_($value['id']);
            $data[$key]['url'] = _SERVER_ . '/public/usersData/' . $_SESSION['login'] . '/' . $value['url'];
            $data[$key]['date'] = $value['Date'];
        }
        exit(json_encode($data));
    }
}


?>