<?php
function    send_mail($id, $login, $email, $token){
    $sub = 'Camagru Verification email';
    $msg = 'Hi! '.$login.' Thank you for singning up in Camagru!
    Your account has been created, you can login after you have activated your account by pressing the url below.
    Please click this link to activate your account:
     <a href=http://'.$_SERVER["HTTP_HOST"].'/app/view/php/activemail.view.php?id='.$id.'&token='.$token.'>click her</a>';
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
     $headers .= 'From: Camagru'."\r\n".
    'Reply-To: no-reply'."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    mail($email, $sub, $msg, $headers);
}
?>