<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/schimaDefine.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes.php';
// session_start();

function    get_avatar(){
    global $DB_SELECT, $PARAM;    
    // $id_imge = (new dbselect())->select($DB_SELECT['_id'], 'avatar', 'Users', $_SESSION['uid'],    $PARAM['int'], 0);
    $url = (new dbselect())->select($DB_SELECT['_uid'], 'url', 'Avatar', $_SESSION['uid'], $PARAM['int'], 0);
    echo (_PATH_.$_SESSION['login'].'/'.$url['url']);
}

?>
    <img class="img btn" src="<?php get_avatar(); ?>" onclick="clickbtn(this)" />
    <ul class="list hidden">
        <li onclick="location.href='/app/view/php/camera.view.php'">Camera</li>
        <li onclick="location.href='/app/view/php/profile.view.php'">your profile</li>
        <li onclick="location.href='/app/view/php/home.view.php'">home</li>
        <li onclick="location.href='/app/view/php/settings.view.php'">settings</li>
        <li onclick="location.href='/app/view/php/logout.view.php'">logout</li>
    </ul>
<script type="text/javascript" src="../js/menu.js"></script>
