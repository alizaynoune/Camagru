<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/schimaDefine.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/filter.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || $_POST['submit'] !== 'OK'){ ///value of sumbit
    header('HTTP/1.1 307 Temporary Redirect');
	header("Location: ../view/php/newpwd.view.php?error=method not valid");
	exit;
}

$pwd = $_POST['passwd'];
$confpwd = $_POST['confPasswd'];
$token = $_POST['token'];
$id = $_POST['id'];
$error = '';

if (empty($pwd) || empty($confpwd))
    $error = '?error=invalid information';
else if (filter_pwd($pwd) === false)
    $error = '?error='.$ERROR;
else if (filter_config_pwd($pwd, $confpwd) === false)
    $error = '?error='.$ERROR;
if (!empty($error)){
    header('HTTP/1.1 307 Temporary Redirect');
	header("Location: ../view/php/newpwd.view.php".$error);
	exit;
}
$hash = hash('whirlpool', 'ali'.$pwd.'zaynoune');
$rslt = (new dbselect())->select($DB_SELECT['_uid'], '*', 'tempemail', $_POST['id'], $PARAM['int'], 1);

if (empty($rslt)){
    header('HTTP/1.1 307 Temporary Redirect');
	header("Location: ../view/php/newpwd.view.php?error=invalid link");
	exit;
}
$error = '?error=invalid information';
foreach ($rslt as $key => &$value){
    if ($value['uid'] === $id && $value['token'] === $token){
        (new dbinsert())->update($DB_UPDATE['_id'], 'Users', 'pwd=?', array($hash , $value['uid']), array($PARAM['str'], $PARAM['int']));
        (new dbinsert())->drop($DB_DELETE['_active_email'], 'tempemail', 'email', $value['email'], $PARAM['str']);
        $error = '';
    }   
}

if (!empty($error)){
    header('HTTP/1.1 307 Temporary Redirect');
	header("Location: ../view/php/newpwd.view.php".$error);
	exit;
}
else{
    header("Location: ../view/php/login.view.php?success=password changed");
	exit;
}


?>