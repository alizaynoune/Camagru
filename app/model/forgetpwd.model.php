<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/schimaDefine.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/filter.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/sendMail.model.php';

if ((new Session())->SessionStatus() === true){
    header("Location: ../view/php/home.view.php");
	exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || $_POST['submit'] !== 'OK'){
	header("Location: ../view/php/forgetpwd.view.php?error=method not valid");
	exit;
}

$login = $_POST['login'];
$email = $_POST['email'];
$error = '';
if (empty($login))
    $error = '?error=empty login';
else if (empty($email))
    $error = '?error=empty email';
else if (filter_login($login) === false)
    $error = '?error='.$ERROR;
else if (filter_email($email) === false)
    $error = '?error='.$ERROR;
else if (exist_login($login) === false)
    $error = '?error=invalid login';
else if (exist_email($email) === false)
    $error = '?error=invalid email';

//// where ask forgeting Password we will creat new toke and sed it to your email ////////
if (empty($error)){
    $rslt = (new dbselect())->select($DB_SELECT['_login'], 'id, email', 'Users', $login, $PARAM['str'], 0);
    if (!isset($rslt) || $rslt['email'] !== $email)
        $error = '?error=invalid information';
}
if (!empty($error)){
    header("Location: ../view/php/forgetpwd.view.php".$error);
	exit;
}

else{
    $token = md5(rand(1000, 5000));
    (new dbinsert())->insert(
        $DB_INSERT['_email_user'],
        array($rslt['id'] , $email, $token),
        array($PARAM['int'], $PARAM['str'], $PARAM['str']),
        0
    );
    send_mail($rslt['id'], $login, $email, $token, 'pwd');
    $seccess = '?success=we send you link change password to your email please check it';
    header("Location: ../view/php/forgetpwd.view.php".$seccess);
    exit;

}
?>