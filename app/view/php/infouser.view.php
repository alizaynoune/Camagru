<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/schimaDefine.php';
// session_start();

function    get_image_profile(){
    global $DB_SELECT, $PARAM;    
    $id_imge = (new dbselect())->select($DB_SELECT['_id'], 'photoid', 'Users', $_SESSION['uid'],    $PARAM['int']);
    $url =     (new dbselect())->select($DB_SELECT['_id'], 'url',     'Posts', $id_imge['photoid'], $PARAM['int']);
    echo($url['url']);
}

?>
    <img class="img btn" src="<?php get_image_profile(); ?>" onclick="clickbtn(this)" />
    <ul class="list hidden">
        <li onclick="location.href='/app/view/php/camera.view.php'">Camera</li>
        <li onclick="location.href='/app/view/php/profile.view.php'">your profile</li>
        <li onclick="location.href='/app/view/php/home.view.php'">home</li>
        <li onclick="location.href='/app/view/php/settings.view.php'">settings</li>
        <li onclick="location.href='/app/view/php/logout.view.php'">logout</li>
    </ul>
<script type="text/javascript" src="../js/menu.js"></script>
