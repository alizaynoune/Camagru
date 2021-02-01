<?php
if (!isset($_GET['id']) || !isset($_GET['token']) || empty($_GET['id']) || empty($_GET['token'])){
    header("Location: ../view/php/login.view.php".$ERROR);
    exit();
}

else{
    // echo $_GET['id'].' '.$_GET['token'].'</br';
    // foreach($_SERVER as $ke => $valu){
    //     echo $ke .' => '.$valu.'</br>';
    // }
    
}


?>