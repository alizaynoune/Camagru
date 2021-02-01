<?php

function    send_mail($id, $email, $token){
    $sub = 'Camagru Verification email';
    $msg = 'Thank you for singning up in Camagru!
    Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
    Please click this link to activate your account:
     <a href=http://'.$_SERVER["REMOTE_ADDR"].':'.$_SERVER["SERVER_PORT"].'/app/model/emailActive.model.php?id='.$id.'&token='.$token.'>click her</a>';
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
     $headers .= 'From: Camagru'."\r\n".
    'Reply-To: no-reply'."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    mail($email, $sub, $msg, $headers);
}

?>