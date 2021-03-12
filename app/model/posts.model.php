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
// $uid = decrypt_($info[1]);
$comment = $data['comment'];
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
	$total_commetns = (new dbselect())->select($DB_SELECT['_id'], 'nbr_comments', 'Posts', $pid , $PARAM['int'], 0);;
}


exit(json_encode($total_commetns));

?>