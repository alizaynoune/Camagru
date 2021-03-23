<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/filter.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/encrypt_decrypt.model.php';

if ((new Session())->SessionStatus() === false){
    header("Location: ../view/php/login.view.php");
	exit(json_encode(false));
}
if (!empty($_POST['title']) && (filter_title($_POST['title']) === false || strlen($_POST['title']) > 50)){
    exit(json_encode(false));
}

if (empty($_POST['canva'])){
    exit(json_encode(false));
}

//////// creat new post ////////////

$uid = $_SESSION['uid'];
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
        $destX = ($Left[$key] * $dw) / 100;
        $destY = ($Top[$key] * $dh) / 100;
        $srcH = ($height[$key] * $dh) / 100;
        $srcW = ($width[$key] * $dw) / 100;
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
        $DB_INSERT['_post'], array($uid, $name),
        array($PARAM['int'], $PARAM['str']),
        1
    );
}
else {
    $id = (new dbinsert())->insert(
        $DB_INSERT['_post_title'], array($uid, $name, htmlspecialchars($_POST['title'])),
        array($PARAM['int'], $PARAM['str'], $PARAM['str']),
        1
    );
}

$ret = (new dbselect())->select($DB_SELECT['_id'], '*', 'Posts', $id['id'], $PARAM['int'], 0);
$uid = $ret['uid'];
$user_name = (new dbselect())->select($DB_SELECT['_id'], 'login', 'Users', $ret['uid'], $PARAM['int'], 0);
$avatar = (new dbselect())->select($DB_SELECT['_uid'], 'url', 'Avatar', $ret['uid'], $PARAM['int'], 0);
foreach($ret as $key => &$value){
    if ($key === 'id' || $key === 'uid'){
        $value = encrypt_($value);
    }
    else if ($key === 'url'){
        $value = _SERVER_ . '/public/usersData/' . $user_name['login'] . '/' . $value;
    }
}
$ret += array('u_name' => $user_name['login']);
$ret += array('u_avatar' => _SERVER_ . '/public/usersData/' . $user_name['login'] . '/' . $avatar['url']);

exit(json_encode($ret));
?>