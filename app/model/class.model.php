<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/schimaDefine.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/database.php';

class	insert extends db_conn {
    private		$stmt;
    private     $sql;

	function	__construc($ins, $values){
        self::connect_use();
		try{
            $this->stmt = $this->conn->prepare($ins);
            $this->stmt->binParam($values);
            $this->stmt->execute();
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
        // echo 'done';
        self::connect_use();
        $this->sql = str_replace(':select:', $select, $cmd);
        $this->sql = str_replace(':table:', $table, $this->sql);
        // echo $this->sql;
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
    private static $user;

    public function start($newlogin){
        global $DB_SELECT;
        self::$user = (new dbselect())->select($DB_SELECT['_login'], 'login, id', 'Users', $newlogin, $PARAM['str']);
        // self::$user = self::select('login, id', 'Users', 'login', $newlogin);
        if (!empty(self::$user)){
            session_start();
            $_SESSION['login'] = self::$user['login'];
            $_SESSION['uid'] = self::$user['id'];
            return(true);
        }
        else{
            return(false);
        }
    }

    public  function logout(){
        session_start();
        unset($_SESSION["login"]);
        unset($_SESSION["id"]);
    }
}

