<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/schimaDefine.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/encrypt_decrypt.model.php';

(new Session())->SessionStatus();


// print_r($_POST);

$data = json_decode($_POST['data'], true);
$post = explode('_leet_', $data['post']);
$pid = decrypt_($post[0]);

$likes_comments = (new dbselect())->select($DB_SELECT['_id'], 'nbr_likes, nbr_comments', 'Posts', $pid, $PARAM['int'], 0);
if (empty($likes_comments))
    exit(json_encode(false));
$is_like = (new dbselect())->is_like_post($_SESSION['uid'], $pid);
$likes_comments['is_like'] = !empty($is_like) ? '1' : '0';

$all_commets = (new dbselect())->fetch_comment($pid);

foreach($all_commets as $key => &$value){
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

$ret = [];
$ret['likes_comments'] = $likes_comments;
$ret['all_comments'] = $all_commets;
$ret['post_info'] = $data['post'];

exit(json_encode($ret));


?>