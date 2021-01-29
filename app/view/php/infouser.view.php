<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/schimaDefine.php';
session_start();

function    get_image_profile(){
    global $DB_SELECT;    
    $id_imge = (new dbselect())->select($DB_SELECT['_id'], 'photoid', 'Users', $_SESSION['uid'],    $PARAM['int']);
    $url =     (new dbselect())->select($DB_SELECT['_id'], 'url',     'Posts', $id_imge['photoid'], $PARAM['int']);
    echo($url['url']);
}

?>

<div class="head_profile">
    <img class="img" src="<?php get_image_profile(); ?>" />
    <div class="menuBtn" onclick="clickbtn(this)">
          <div class="menuLine" id="line1"></div>
          <div class="menuLine" id="line2"></div>
          <div class="menuLine" id="line3"></div>
    </div>
    <ul class="list hidden">
        <a href="/app/view/php/camera.view.php"><li>Camera</li></a>
        <a href="/app/view/php/profile.view.php"><li>your profile</li></a>
        <a href="/app/view/php/home.view.php"><li>home</li></a>
        <a href="/app/view/php/settings.view.php"><li>settings</li></a>
        <a href="/app/view/php/logout.view.php"><li>logout</li></a>
    <ul>
</div>
<script type="text/javascript" src="../js/menu.js"></script>
