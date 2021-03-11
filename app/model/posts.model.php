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
$login = $data['login'];
$comment = $data['comment'];
// valid comment befor insert//////////////////////////////////////
if ($uid !== $_SESSION['uid'] || $login !== $_SESSION['login'] || filter_comment($comment) === false){
    exit(json_encode(false));
}

else {
//    $id = (new dbinset())->insert(
//         $DB_INSERT['_comment'],
//         array($uid, $pid, $data['comment']),
//         array($PARAM['int'], $PARAM['int'], $PARAM['str']),
//         0
//     );

    $id = (new dbinsert())->insert(
		$DB_INSERT['_comment'],
		array($uid , $pid, $comment),
		array($PARAM['int'], $PARAM['int'], $PARAM['str']),
		1
	);
}


exit(json_encode($id));

?>