<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/schimaDefine.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/database.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/encrypt_decrypt.model.php';


// class of insert in database///
class	dbinsert extends db_conn {
    private		$stmt;
    private     $stmt_id;
    protected   $lasr_id;

	public function	insert($ins, $values, $param, $ret_id){
        if (parent::connect_use() === false){
            return(false);
        }
		try{
            $this->stmt = $this->conn->prepare($ins);
            foreach ($values as $key => &$value){
                $this->stmt->bindParam($key + 1 , $value, $param[$key]);
            }
            if ($ret_id === 1)
                $this->stmt_id = $this->conn->prepare('SELECT LAST_INSERT_ID() AS `id`');
            $this->stmt->execute();
            if ($ret_id === 1){
                $this->stmt_id->execute();
                return($this->stmt_id->fetch(PDO::FETCH_ASSOC));
            }
		} catch(PDOException $e){
            return(false);
        }
        parent::Desconnect();
    }
    public  function    update($cmd, $table, $set, $values, $param){
        if (parent::connect_use() === false){
            return(false);
        }
        $this->sql = str_replace(':table:', $table, $cmd);
        $this->sql = str_replace(':set:', $set, $this->sql);
        try{
            $this->stmt = $this->conn->prepare($this->sql);
            foreach ($values as $key => &$value){
                $this->stmt->bindParam($key + 1, $value, $param[$key]);
            }
            $this->stmt->execute();
        }catch(PDOException $e){
            parent::Desconnect();
            return(false);
        }
        parent::Desconnect();
    }
    public  function drop($cmd, $table, $where, $value, $param){
        if (parent::connect_use() === false){
            return(false);
        }
        $this->sql = str_replace(':table:', $table, $cmd);
        $this->sql = str_replace(':where:', $where, $this->sql);
        try{
            $this->stmt = $this->conn->prepare($this->sql);
            $this->stmt->bindParam(1, $value, $param);
            $this->stmt->execute();

        }catch(PDOException $e){
            parent::Desconnect();
            return(false);
        }
        parent::Desconnect();
    }
    
    
}


////// class Select from dataBase/////
class   dbselect extends db_conn {
    private     $stmt;
    private     $rslt;
    private     $sql;

    public function    select($cmd, $select, $table, $values, $param, $fetch){
        if (parent::connect_use() === false){
            return(null);
        }
        $this->sql = str_replace(':select:', $select, $cmd);
        $this->sql = str_replace(':table:', $table, $this->sql);
        try{
            $this->stmt = $this->conn->prepare($this->sql);
            $this->stmt->bindParam(1, $values, $param);
            $this->stmt->execute();
            if ($fetch === 0)
                $this->rslt = $this->stmt->fetch(PDO::FETCH_ASSOC);
            else if ($fetch === 1)
                $this->rslt = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
            parent::Desconnect();
            return ($this->rslt);
        }catch(PDOException $e){
            parent::Desconnect();
            return(null);
        }
        parent::Desconnect();
    }

    public    function     fetch_user_post($uid, $date){
        if (parent::connect_use() === false){
            return(null);
        }

        
        try{
            if ($date === '0'){
                $this->sql = 'SELECT * FROM Posts WHERE uid=? ORDER BY `Date` DESC LIMIT 5';
                $this->stmt = $this->conn->prepare($this->sql);
                $this->stmt->bindParam(1, $uid, PDO::PARAM_INT);
                $this->stmt->execute();
            }
            else {
                $this->sql = 'SELECT * FROM Posts WHERE `Date`<? AND uid=? ORDER BY `Date` DESC LIMIT 5';
                $this->stmt = $this->conn->prepare($this->sql);
                $this->stmt->bindParam(1, $date, PDO::PARAM_STR);
                $this->stmt->bindParam(2, $uid, PDO::PARAM_INT);
                $this->stmt->execute();
            }
            $this->rslt = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
            

        }catch(PDOException $e){
            parent::Desconnect();
            return(null);
        }

        parent::Desconnect();
        return($this->rslt);

    }

    public      function    fetch_all_post($date){        
        if (parent::connect_use() === false){
            return(null);
        }
        
        try{
            if ($date === '0'){
                $this->sql = 'SELECT * FROM Posts ORDER BY `Date` DESC LIMIT 5;';
                $this->stmt = $this->conn->prepare($this->sql);
                $this->stmt->execute();
                
            }
            else{
                $this->sql = 'SELECT * FROM Posts WHERE `Date`<? ORDER BY `Date` DESC LIMIT 5';
                $this->stmt = $this->conn->prepare($this->sql);
                $this->stmt->bindParam(1, $date, PDO::PARAM_STR);
                $this->stmt->execute();
            }
            $this->rslt = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
            
        }catch(PDOException $e){
            parent::Desconnect();
            return(null);
        }
        parent::Desconnect();
        return($this->rslt);
    }

    public function     fetch_comment($id){
        if (parent::connect_use() === false){
            return(null);
        }
        
        try{
            $this->sql = 'SELECT * FROM Comments WHERE `pid`=? ORDER BY `Date` ASC';
            $this->stmt = $this->conn->prepare($this->sql);
            $this->stmt->bindParam(1, $id, PDO::PARAM_INT);

            $this->stmt->execute();
            $this->rslt = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
            parent::Desconnect();
            return($this->rslt);
        }catch(PDOException $e){
            parent::Desconnect();
            return(null);
        }
    }

    public function     is_like_comment($uid, $cid){
        if (parent::connect_use() === false){
            return(null);
        }
        try{
            $this->sql = 'SELECT id FROM CommentLikes WHERE `cid`=? AND `uid`=?;';
            $this->stmt = $this->conn->prepare($this->sql);
            $this->stmt->bindParam(1, $cid, PDO::PARAM_INT);
            $this->stmt->bindParam(2, $uid, PDO::PARAM_INT);
            $this->stmt->execute();
            $this->rslt = $this->stmt->fetch(PDO::FETCH_ASSOC);
            parent::Desconnect();
            return($this->rslt);
        }catch(PDOException $e){
            parent::Desconnect();
            return(null);
        }
    }

    public  function    is_like_post($uid, $pid){
        if (parent::connect_use() === false){
            return(null);
        }
        try{
            $this->sql = 'SELECT id FROM PostLikes WHERE `pid`=? AND `uid`=?;';
            $this->stmt = $this->conn->prepare($this->sql);
            $this->stmt->bindParam(1, $pid, PDO::PARAM_INT);
            $this->stmt->bindParam(2, $uid, PDO::PARAM_INT);
            $this->stmt->execute();
            $this->rslt = $this->stmt->fetch(PDO::FETCH_ASSOC);
            parent::Desconnect();
            return($this->rslt);
        }catch(PDOException $e){
            parent::Desconnect();
            return(null);
        }
    }

}

/////// class creat or delete Session ///////
class   Session extends dbselect {
    static $user;

    static function start($newlogin){
        global $DB_SELECT, $PARAM;
        self::$user = (new dbselect())->select($DB_SELECT['_login'], 'id, login, firstname', 'Users', $newlogin, $PARAM['str'], 0);
        if (!empty(self::$user)){
            session_start();
            $_SESSION['login'] = self::$user['login'];
            $_SESSION['uid'] = self::$user['id'];
            $_SESSION['name'] = self::$user['firstname'];
            return(true);
        }
        else{
            return(false);
        }
    }

    static function logout(){
        if (empty($_SESSION['login']))
            session_start();
        unset($_SESSION["login"]);
        unset($_SESSION["uid"]);
        unset($_SESSION['firstname']);
        session_destroy();
    }
    public function     SessionStatus(){
        if (session_status() === PHP_SESSION_NONE)
            session_start();
        if (empty($_SESSION['login'])){
            session_destroy();
            return(false);
        }
        else
            return(true);
    }
}