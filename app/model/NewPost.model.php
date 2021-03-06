<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes.php';
if ((new Session())->SessionStatus() === false){
    header("Location: ../view/php/login.view.php");
	exit();
}
// print_r($_POST);die();

if (empty($_POST['canva']))
    exit(-1);

$base64 = str_replace('data:image/png;base64,', '', $_POST['canva']);
$base64 = str_replace(' ', '+', $base64);
$cava = base64_decode($base64);
list($dw, $dh) = getimagesizefromstring($cava);
$data = imagecreatefromstring($cava);
// $dest = imagecreatetruecolor($dw, $dh);
// imagecolortransparent($dest, imagecolorallocatealpha($dest, 255, 255, 255, 127));
// imagealphablending($dest, false);
// imagesavealpha($dest, true);
// imagecopy($dest, $data, 0, 0, 0, 0, $dw, $dh);
// imagedestroy($data);
$dest = $data;
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
        $originStiker = imagecreatefrompng($StickerPath . $Stickers[$key]);
        list($Sw, $Sh) = getimagesize($StickerPath . $Stickers[$key]);
        // var_dump($Sw);
        // var_dump($Sh); die();
        $new = imagecreatetruecolor($srcW, $srcH);
        imagecolortransparent($new, imagecolorallocatealpha($new, 255, 255, 255, 127));
        imagealphablending($new, false);
        imagesavealpha($new, true);
        imagecopyresampled($new, $originStiker, 0, 0, 0, 0, $srcW, $srcH, $Sw, $Sh);
        imagecopy($dest, $new, $srcX, $srcY, 0, 0, $srcW, $srcH);
        // imagedestroy($new);
    }
}
$name = md5(microtime()).'.png';
imagepng($dest, $path.$name);
// imagedestroy($des);
// $_SESSION['uid']
$id = (new dbinsert())->insert(
    $DB_INSERT['_post'], array($_SESSION['uid'], $name),
    array($PARAM['int'], $PARAM['str']),
    1
);
$content = 'data:image/png;base64,'.base64_encode(file_get_contents($path.$name));
array_push($id, ($content));
exit(json_encode($id));
?>