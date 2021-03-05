<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes.php';
if ((new Session())->SessionStatus() === false){
    header("Location: ../view/php/login.view.php");
	exit();
}

$base64 = str_replace('data:image/png;base64,', '', $_POST['canva']);
$base64 = str_replace(' ', '+', $base64);
$cava = base64_decode($base64);
list($dw, $dh) = getimagesizefromstring($cava);
$data = imagecreatefromstring($cava);
$dest = imagecreatetruecolor($dw, $dh);
imagecolortransparent($dest, imagecolorallocatealpha($dest, 0, 0, 0, 127));
imagealphablending($dest, false);
imagesavealpha($dest, true);
imagecopy($dest, $data, 0, 0, 0, 0, $dw, $dh);
imagedestroy($data);
$path = APP_ROOT.'/public/usersData/'.$_SESSION['login'].'/';

if (!empty($_POST['stickers'])){
    $StickerPath = APP_ROOT.'/app/view/stickers/';
    $Stickers = explode(',', $_POST['stickers']);
    $Top = explode(',', $_POST['top']);
    $Left = explode(',', $_POST['left']);
    $width = explode(',', $_POST['width']);
    $height = explode(',', $_POST['height']);
    // $dest = imagecreatetruecolor($srcW, $srcH);
    foreach($Stickers as $key => $value){
        $srcX = $Left[$key];
        $srcY = $Top[$key];
        $srcH = $height[$key];
        $srcW = $width[$key];
        $originStiker = imagecreatefrompng($StickerPath.$Stickers[$key]);
        list($Sw, $Sh) = getimagesize($StickerPath.$Stickers[$key]);
        $new = imagecreatetruecolor($srcW, $srcH);
        imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 127));
        imagealphablending($new, false);
        imagesavealpha($new, true);
        imagecopyresampled($new, $originStiker, 0, 0, 0, 0, $srcW, $srcH, $Sw, $Sh);
        imagecopy($dest, $new, $srcX, $srcY, 0, 0, $srcW, $srcH);
        imagedestroy($new);
    }
}
// file_put_contents($path.'ali.png', $dest);
imagepng($dest, $path.'ali.png');
// echo $path;
// header('Content-Type: image/gif'); 
// imagepng($dest);
imagedestroy($dest);
?>