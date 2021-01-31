<?php

function    send_mail($id, $email){
    $msg = "test".$id;
    $sub = "sub";

    mail($email, $sub, $msg);
}

?>