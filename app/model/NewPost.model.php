<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes.php';
if ((new Session())->SessionStatus() === false){
    header("Location: ../view/php/login.view.php");
	exit();
}


// print_r($_POST);
// echo $_POST['InfoStickers'];
// print_r($_SERVER);
// print_r($_FILES);
// echo '</br>';
// print_r($_FILES);
// print_r(testCanvas.toDataURL("image/png"));


// header("Content-type: image/png");
// $data = "/9j/4AAQSkZJRgABAQEAYABgAAD........";
// echo '<img src="'.$_POST['canva'].'"/>';
$img = imagecreatefrompng($_POST['canva']);
// print_r($_SESSION);
// echo '</br>';
$path = APP_ROOT.'/public/usersData/'.$_SESSION['login'].'/';
$name = md5(rand(1000, 5000));
$img = str_replace('data:image/png;base64,', '', $_POST['canva']);
$img = str_replace(' ', '+', $img);
// echo ($img);

// imagedestroy($_POST['canva']);
file_put_contents($path.'ali.png', base64_decode($img));



// $exten = pathinfo($avatar, PATHINFO_EXTENSION);
$fileContent = file_get_contents($path.'ali.png');
$new_img = 'data:image/png;base64,'.base64_encode($fileContent);

if (!empty($_POST['stickers'])){
    // echo $_POST['stickers'];
    
    $StickerPath = APP_ROOT.'/app/view/stickers/';
    $Stickers = explode(',', $_POST['stickers']);
    $Top = explode(',', $_POST['top']);
    $Left = explode(',', $_POST['left']);
    $Size = explode(',', $_POST['size']);
    $Retate = explode(',', $_POST['retate']);

    // print_r($Stickers);
    // echo '</br>';
    // print_r($Top);
    // echo '</br>';
    // print_r($Left);
    // echo '</br>';
    // print_r($Size);
    // echo '</br>';
    // print_r($Retate);
    // $dest = imagecreatefrompng($StickerPath.$Stickers[0]);
    // echo '<img src="'.$StickerPath.$Stickers[0].'"/>';
    $dest = imagecreatefrompng($path.'ali.png');
    $src = imagecreatefrompng($StickerPath.$Stickers[0]);
    $srcX = $Left[0];
    $srcY = $Top[0];
    // $destX = ;
    // $destY;
    $srcH = $Size[0];
    $srcW = $Size[0];

    // $src = imagecreatefrompng('https://media.geeksforgeeks.org/wp-content/uploads/col1.png'); 
          
        // Copy and merge 
        imagecopymerge($dest, $src, $srcX, $srcY, $srcW, $srcH, $srcW, $srcH, 100);
        header('Content-Type: image/png'); 
        imagegif($dest);
}




// echo '<img src="'.$new_img.'"/>';
// print_r($_SERVER);


// else {
//     echo 'is empty';
// }

// header("Location: ../view/php/camera.view.php");

?>