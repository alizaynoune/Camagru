<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/schimaDefine.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/database.php';

class	dbinsert extends db_conn {
    private		$stmt;
    private     $stmt_id;
    protected   $lasr_id;

	public function	insert($ins, $values, $param, $ret_id){
        self::connect_use();
		try{
            $this->stmt = $this->conn->prepare($ins);
            foreach ($values as $key => &$value){
                $this->stmt->bindParam($key + 1 , $value, $param[$key]);
            }
            if ($ret_id === 1)
                $this->stmt_id = $this->conn->prepare('SELECT LAST_INSERT_ID() AS `id`');
            $this->stmt->execute();
            if ($ret_id){
                $this->stmt_id->execute();
                return($this->stmt_id->fetch(PDO::FETCH_ASSOC));
            }
		} catch(PDOException $e){
            die ("Error : ". $e->getMessage());
            exit();
        }
        self::Desconnect();
    }

    
    
}

class   dbselect extends db_conn {
    private     $stmt;
    private     $rslt;
    private     $bnd;
    private     $sql;

    public function    select($cmd, $select, $table, $values, $param){
        self::connect_use();
        $this->sql = str_replace(':select:', $select, $cmd);
        $this->sql = str_replace(':table:', $table, $this->sql);
        try{
            $this->stmt = $this->conn->prepare($this->sql);
            $this->stmt->bindParam(1, $values, $param);
            $this->stmt->execute();
            $this->rslt = $this->stmt->fetch(PDO::FETCH_ASSOC);
            self::Desconnect();
            return ($this->rslt);
        }catch(PDOException $e){
            self::Desconnect();
            die ("Error : ". $e->getMessage());
        }
    }
}

class   Session extends dbselect {
    static $user;

    static function start($newlogin){
        global $DB_SELECT, $PARAM;
        self::$user = (new dbselect())->select($DB_SELECT['_login'], 'id, login, firstname', 'Users', $newlogin, $PARAM['str']);
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
        session_start();
        unset($_SESSION["login"]);
        unset($_SESSION["uid"]);
        unset($_SESSION['firstname']);
        session_destroy();
    }
}

