<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/filter.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes.php';
if ((new Session())->SessionStatus() === false){
    header("Location: ../view/php/login.view.php");
	exit();
}

else if (!empty($_POST['title']) && (filter_comment($_POST['title']) === false || strlen($_POST['title']) > 50)){
    exit();
}

$base64 = str_replace('data:image/png;base64,', '', $_POST['canva']);
$base64 = str_replace(' ', '+', $base64);
$cava = base64_decode($base64);
list($dw, $dh) = getimagesizefromstring($cava);
$dest = imagecreatefromstring($cava);
$path = APP_ROOT.'/public/usersData/'.$_SESSION['login'].'/';

if (!empty($_POST['stickers'])){
    $StickerPath = APP_ROOT.'/app/view/stickers/';
    $Stickers = explode(',', $_POST['stickers']);
    $Top = explode(',', $_POST['top']);
    $Left = explode(',', $_POST['left']);
    $width = explode(',', $_POST['width']);
    $height = explode(',', $_POST['height']);
    foreach($Stickers as $key => $value){
        $destX = $Left[$key];
        $destY = $Top[$key];
        $srcH = $height[$key];
        $srcW = $width[$key];
        $originStiker = imagecreatefrompng($StickerPath . $Stickers[$key]);
        list($Sw, $Sh) = getimagesize($StickerPath . $Stickers[$key]);
        $new = imagecreatetruecolor($srcW, $srcH);
        imagecolortransparent($new, imagecolorallocatealpha($new, 255, 255, 255, 127));
        imagealphablending($new, false);
        imagesavealpha($new, true);
        imagecopyresampled($new, $originStiker, 0, 0, 0, 0, $srcW, $srcH, $Sw, $Sh);
        imagecopy($dest, $new, $destX, $destY, 0, 0, $srcW, $srcH);
        imagedestroy($new);
    }
}
$name = md5(microtime()).'.png';
imagepng($dest, $path.$name);
if (empty($_POST['title'])){
    $id = (new dbinsert())->insert(
        $DB_INSERT['_post'], array($_SESSION['uid'], $name),
        array($PARAM['int'], $PARAM['str']),
        1
    );
}
else {
    $id = (new dbinsert())->insert(
        $DB_INSERT['_post_title'], array($_SESSION['uid'], $name, $_POST['title']),
        array($PARAM['int'], $PARAM['str'], $PARAM['str']),
        1
    );
}
$content = 'data:image/png;base64,'.base64_encode(file_get_contents($path.$name));
array_push($id, ($content));
array_push($id, ($_POST['title']));
exit(json_encode($id));
?>