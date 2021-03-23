<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/schimaDefine.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/encrypt_decrypt.model.php';

function    get_avatar(){
    global $DB_SELECT, $PARAM;
    $url = (new dbselect())->select($DB_SELECT['_uid'], 'url', 'Avatar', $_SESSION['uid'], $PARAM['int'], 0);
    return(_SERVER_ . '/public/usersData/' . $_SESSION['login'] . '/' . $url['url']);
}

?>
<img class="img btn" src="<?php echo get_avatar(); ?>" onclick="clickbtn(this)" />
<script type="text/javascript" src="../js/menu.js"></script>
