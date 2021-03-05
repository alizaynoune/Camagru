<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes.php';
if ((new Session())->SessionStatus() === false){
    header("Location: ../view/php/login.view.php");
	exit();
}

$base64 = str_replace('data:image/png;base64,', '', $_POST['canva']);
$base64 = str_replace(' ', '+', $base64);
$data = base64_decode($base64);
$img = imagecreatefromstring($data);

$path = APP_ROOT.'/public/usersData/'.$_SESSION['login'].'/';

if (!empty($_POST['stickers'])){
    // echo $_POST['stickers'];
    
    $StickerPath = APP_ROOT.'/app/view/stickers/';
    $Stickers = explode(',', $_POST['stickers']);
    $Top = explode(',', $_POST['top']);
    $Left = explode(',', $_POST['left']);
    $Size = explode(',', $_POST['size']);
    $Retate = explode(',', $_POST['retate']);
    
    
    foreach($Stickers as $key => $value){
        $srcX = $Left[$key];
        $srcY = $Top[$key];
        $srcH = $Size[$key];
        $srcW = $Size[$key];
        $stik = imagecreatefrompng($StickerPath.$Stickers[$key]);
        imagealphablending($stik, false);
        imagesavealpha($stik, true);
        $ret = imagerotate($stik, ($Retate[$key] * -1), imageColorAllocateAlpha($stik, 0, 0, 0, 127));
        // imagealphablending($ret, false);
        // imagesavealpha($ret, true);
        $src = imagescale($ret, $srcW, $srcH);
        imagecopy($img, $src, $srcX, $srcY, 0, 0, $srcW, $srcH);
    }
}

header('Content-Type: image/gif'); 
imagegif($img);

?>