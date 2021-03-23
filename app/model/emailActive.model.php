<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/schimaDefine.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';

//////////// active Users by email activetion /////////
function    emailactive(){
    global $DB_DELETE, $DB_SELECT, $DB_UPDATE, $PARAM;
    if (!isset($_GET) || empty($_GET['id']) || empty($_GET['token'])){
        return(false);
    }
    else{
        $rslt = (new dbselect())->select($DB_SELECT['_uid'], '*', 'tempemail', $_GET['id'], $PARAM['int'], 1);
        $is_active = (new dbselect())->select($DB_SELECT['_id'], 'login, email, active', 'Users', $_GET['id'], $PARAM['int'], 0);
        $Path = $_SERVER['DOCUMENT_ROOT'].'/public/usersData/'.$is_active['login'];
        foreach($rslt as $key => &$value){
            if ($value['uid'] === $_GET['id'] && $value['token'] === $_GET['token']){
                if ($is_active['active'] === 'true'){
                    return(false);
                }
                if (file_exists($Path))
                    shell_exec('rm -rf ' . $Path);
                if (!mkdir($Path, 0777, true))
                    return(false);
                else{
                    (new dbinsert())->update(
                        $DB_UPDATE['_id'], 'Users', 'email=?,active=?',
                        array($value['email'], 'true', $value['uid']),
                        array($PARAM['str'],
                        $PARAM['bool'], $PARAM['int']));
                    (new dbinsert())->drop($DB_DELETE['_active_email'], 'tempemail', 'email', $value['email'], $PARAM['str']);
                }
                return(true);
            }
        }
        return(false);
    }
}

function    emailupdate(){
    global $DB_DELETE, $DB_SELECT, $DB_UPDATE, $PARAM;
    if (!isset($_GET) || empty($_GET['id']) || empty($_GET['token'])){
        
        return(false);
    }
    else{
        $rslt = (new dbselect())->select($DB_SELECT['_uid'], '*', 'tempemail', $_GET['id'], $PARAM['int'], 1);
        $is_active = (new dbselect())->select($DB_SELECT['_id'], 'login, email', 'Users', $_GET['id'], $PARAM['int'], 0);
        foreach ($rslt as $key => &$value){
            if ($value['uid'] === $_GET['id'] && $value['token'] === $_GET['token']){
                if ($is_active['email'] === $value['email']){
                    (new dbinsert())->drop($DB_DELETE['_active_email'], 'tempemail', 'email', $value['email'], $PARAM['str']);
                    return(false);
                }
                else{
                    (new dbinsert())->update($DB_UPDATE['_id'], 'Users', 'email=?', array($value['email'], $value['uid']), array($PARAM['str'], $PARAM['int']));
                    (new dbinsert())->drop($DB_DELETE['_active_email'], 'tempemail', 'email', $value['email'], $PARAM['str']);
                }
                return(true);
            }
        }
    return(false);
    }
}
?>