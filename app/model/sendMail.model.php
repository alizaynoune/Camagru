<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/includes.php';

function    msj_email($param){
    if ($param === 'active'){
        $msg = ' Thank you for singning up in Camagru!
        Your account has been created, you can login after you have activated your account by pressing the url below.
        Please click this link to activate your account: ';
    }
    else if ($param === 'update'){
        $msg = ' Thank you for using Camagru!
        Please click this link to active this email: ';
    }

    else if ($param === 'pwd'){
        $msg = ' Thank you for using Camagru!
        Please click this link to change your password: ';
    }
    return($msg);
}

function    sub_email($param){
    if ($param === 'active' || $param === 'update'){
        $msg = ' Camagru Verification email ';
    }

    else if ($param === 'pwd'){
        $msg = 'Camagru Recovery Password';
    }
    return($msg);
}

function    send_mail($id, $login, $email, $token, $param){
    $sub = sub_email($param);
    $msg = 'Hi! '.$login.msj_email($param).
    ' <a href=http://'.$_SERVER["HTTP_HOST"].'/app/view/php/receiveemail.view.php?id='.$id.'&token='.$token.'&param='.$param.'>click her</a>';
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
     $headers .= 'From: Camagru'."\r\n".
    'Reply-To: no-reply'."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    mail($email, $sub, $msg, $headers);
}

?>