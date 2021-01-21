<?php
include './database.php';

class	DB_SETUP extends DBClass{

	private	function DB_EXEC($cmd){
		$this->DB_CONN->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try{
			$this->DB_CONN->exec($cmd);
		} catch(PDOException $e){
			die ("Error : ". $e->getMessage());
		}
	}

	public function create_DB(){
		parent::Connect();
		
		self::DB_EXEC("DROP DATABASE IF EXISTS `$this->DB_NAME`");
		self::DB_EXEC("CREATE DATABASE `$this->DB_NAME`");
	}
}

$test = new DB_SETUP();
echo $test->create_DB();

?>