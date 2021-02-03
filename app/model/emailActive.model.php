<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/schimaDefine.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
function    emailactive(){
    global $DB_DELETE, $DB_SELECT, $DB_UPDATE, $PARAM;
    if (!isset($_GET['id']) || !isset($_GET['token']) || empty($_GET['id']) || empty($_GET['token'])){
        return(false);
    }
    else{
        $rslt = (new dbselect())->select($DB_SELECT['_uid'], '*', 'tempemail', $_GET['id'], $PARAM['int']);
        if ($rslt['uid'] === $_GET['id'] && $rslt['token'] === $_GET['token']){
            $is_active = (new dbselect())->select($DB_SELECT['_id'], 'login, email, active', 'Users', $_GET['id'], $PARAM['int']);
            if ($is_active['email'] === $rslt['email']){
                return(false);
           
            }
            else{
                (new dbinsert())->update($DB_UPDATE['_id'], 'Users', 'email', array($rslt['email'], $rslt['uid']), array($PARAM['str'], $PARAM['int']));
                if ($is_active['active'] !== 'true')
                    (new dbinsert())->update($DB_UPDATE['_id'], 'Users', 'active', array('true', $rslt['uid']), array($PARAM['bool'], $PARAM['int']));
                (new dbinsert())->drop($DB_DELETE['_active_email'], 'tempemail', 'email', $rslt['email'], $PARAM['str']);    
            }
            if (!mkdir($_SERVER['DOCUMENT_ROOT'].'/public/usersData/'.$is_active['login'], 0777, true))
                echo 'error';
            return(true);
        }
        else{
            return(false);
        }
    }
}
?>