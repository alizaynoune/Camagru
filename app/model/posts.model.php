<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/schimaDefine.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/encrypt_decrypt.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/filter.model.php';

if ((new Session())->SessionStatus() === false){
	exit(json_encode(false));
}


$data = json_decode($_POST['data'], true);
$info = explode('_leet_', $data['info']);

$pid = decrypt_($info[0]);
$uid = decrypt_($info[1]);
if ($data['type'] === 'comment'){
	$comment = htmlspecialchars($data['comment']);
	// $comment = $data['comment'];
	// valid comment befor insert//////////////////////////////////////
	if (filter_comment($comment) === false){
	    exit(json_encode(false));
	}

	else {
	    (new dbinsert())->insert(
			$DB_INSERT['_comment'],
			array($_SESSION['uid'] , $pid, $comment),
			array($PARAM['int'], $PARAM['int'], $PARAM['str']),
			0
		);
	}


	exit(json_encode(true));
}
else if ($data['type'] === 'like'){
	$is_like = (new dbselect())->is_like_post($_SESSION['uid'], $pid);
	$is_like['is_like'] = !empty($is_like) ? '1' : '0';
	// print_r($is_like);
	
	if ($data['flag'] === 1 && $is_like['is_like'] === '0'){
		(new dbinsert())->insert(
			$DB_INSERT['_like_post'], array($pid, $_SESSION['uid']),
			array($PARAM['int'], $PARAM['int']),
			0
		);
		exit(json_encode(true));
	}
	
	else if ($data['flag'] === 0 && $is_like['is_like'] === '1'){
		(new dbinsert())->drop($DB_DELETE['_drop'], 'PostLikes', 'id', $is_like['id'], $PARAM['int']);
		exit(json_encode(true));
	}
	
	else{
		exit(json_encode(false));
	}
}

else if ($data['type'] === 'delet_post'){
	$uid = decrypt_($info[1]);
	$pid = decrypt_($info[0]);
	if ($uid === $_SESSION['uid']){
		$post = (new dbselect())->select($DB_SELECT['_id'], 'id, uid', 'Posts', $pid, $PARAM['int'], 0);
		if ($pid === $post['id']){
			(new dbinsert())->drop($DB_DELETE['_drop'], 'Posts', 'id', $pid, $PARAM['int']);
			exit(json_encode(true));
		}
		exit(json_encode(false));
	}
	else{
		exit(json_encode(false));
	}
}
?>