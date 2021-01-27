<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/database.php';

class	Insert extends DBClass {
	private		$stmt;

	function	__construct($cmd){
		self::connect_use();
		try{
			$this->DB_CONN->exec('INSERT INTO '.$cmd);
		} catch(PDOException $e){
			die ("Error : ". $e->getMessage());
		}
	}
}

class   DBGet extends DBClass {
    private     $stmt;
    private     $rslt;

    public function    select($selct, $table, $where, $equ){
        self::connect_use();
        try{
            $this->stmt = $this->DB_CONN->prepare('SELECT '. $selct .' FROM '. $table .' WHERE '. $where .' = ?');
            $this->stmt->execute([$equ]);
            $this->rslt = $this->stmt->fetch(PDO::FETCH_ASSOC);
            unset($this->stmt);
            self::Desconnect();
            return ($this->rslt);
        }catch(PDOException $e){
			die ("Error : ". $e->getMessage());
		}
        
    }

    public  function    selectByLogin($select, $table, $login){

    }
}

class   Session extends DBGet {
    private static $user;

    public function start($newlogin){
        self::$user = self::select('login, id', 'Users', 'login', $newlogin);
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

?>