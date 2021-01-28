<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/database.php';

class	insert extends db_conn {
    private		$stmt;
    private     $sql;

	function	__construc($ins, $values){
        self::connect_use();
		try{
            $this->stmt = $this->conn->prepare($ins);
            $this->stmt->execute($values);
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

    public function    select($select, $values){
        self::connect_use();
        // if (!is_null($this->conn))
                // return($this->conn);
        try{

            $this->stmt = $this->conn->prepare("SELECT  login FROM Users WHERE id = ?");
            // return($this->stmt);
            // echo $select;
            $this->stm->bindParam(1, 1, PDO::PARAM_INT);
            // $values = 'ali-zaynoune';
            $this->stmt->execute();
            $this->rslt = $this->stmt->fetch(PDO::FETCH_ASSOC);
            self::Desconnect();
            return ($this->rslt);
        }catch(PDOException $e){
            self::Desconnect();
            die ("Error : ". $e->getMessage());
            exit();
        }
    }
}

// class   Session extends DBGet {
//     private static $user;

//     public function start($newlogin){
//         self::$user = self::select('login, id', 'Users', 'login', $newlogin);
//         if (!empty(self::$user)){
//             session_start();
//             $_SESSION['login'] = self::$user['login'];
//             $_SESSION['uid'] = self::$user['id'];
//             return(true);
//         }
//         else{
//             return(false);
//         }
//     }

//     public  function logout(){
//         session_start();
//         unset($_SESSION["login"]);
//         unset($_SESSION["id"]);
//     }
// }

?>