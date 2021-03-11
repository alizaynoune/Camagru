<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/schimaDefine.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/encrypt_decrypt.model.php';




$data = json_decode($_POST['data'], true);
$info = explode('_leet_', $data['info']);

$pid = decrypt_($info[0]);
$uid = decrypt_($info[1]);
exit(json_encode($pid . ' '. $uid));

?>