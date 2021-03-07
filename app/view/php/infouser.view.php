<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/schimaDefine.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes.php';

function    get_avatar(){
    global $DB_SELECT, $PARAM;    
    $url = (new dbselect())->select($DB_SELECT['_uid'], 'url', 'Avatar', $_SESSION['uid'], $PARAM['int'], 0);
    $avatar = APP_ROOT.'/public/usersData/'.$_SESSION['login'].'/'.$url['url'];
    $exten = pathinfo($avatar, PATHINFO_EXTENSION);
    $fileContent = file_get_contents($avatar);
    echo 'data:image/'.$exten.';base64,'.base64_encode($fileContent);
}

?>
    <img class="img btn" src="<?php get_avatar(); ?>" onclick="clickbtn(this)" />
<script type="text/javascript" src="../js/menu.js"></script>
