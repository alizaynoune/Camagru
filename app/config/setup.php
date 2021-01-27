<?php
require_once 'database.php';

class	DB_SETUP extends DBClass{
	private	$st;
	private	$sql;
	
	private	function DBquery($cmd){
		try{
			$this->DB_CONN->query($cmd);
		} catch(PDOException $e){
			die ("Error : ". $e->getMessage());
		}
	}

	private	function tables(){
		try{
			$this->DB_CONN->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->sql = file_get_contents('Camagru.sql');
			$this->st = $this->DB_CONN->prepare($this->sql);
			$this->st->execute();
		}catch(PDOException $e){
			die ("Error : ". $e->getMessage());
			exit();
		}
		echo "Create tables".PHP_EOL;
		// print_r($this->st);
	}

	private function create_DB(){
		parent::Connect();
		self::DBquery("DROP DATABASE IF EXISTS `$this->DB_NAME`");
		self::DBquery("CREATE DATABASE `$this->DB_NAME`");
		echo'Create database '.$this->DB_NAME .PHP_EOL;
	}

	function __construct(){
		self::create_DB();
		self::DBquery("USE `$this->DB_NAME`");
		echo 'Connect to database '.$this->DB_NAME .PHP_EOL;
		self::tables();
		$this->DB_CONN = NULL;
	}
}


new DB_SETUP();

?>