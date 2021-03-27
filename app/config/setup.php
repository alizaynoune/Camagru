<?php
define('APP_ROOT', dirname(__DIR__));
require_once APP_ROOT . '/config/database.php';

class	db_setup extends db_conn{
	private	$st;
	private	$sql;
	
	private	function DBquery($cmd){
		try{
			$this->conn->query($cmd);
		} catch(Exception $e){
			die ("Error : ". $e->getMessage());
		}
	}

	private	function tables(){
		try{
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->sql = file_get_contents(APP_ROOT . '/config/Camagru.sql');
			$this->st = $this->conn->prepare($this->sql);
			$this->st->execute();
		}catch(PDOException $e){
			die ("Error : ". $e->getMessage());
		}
		echo "Create tables".PHP_EOL;
	}

	private function create_DB(){
		if (parent::Connect() === false){
			die('Error Connection');
		}
		self::DBquery("DROP DATABASE IF EXISTS `$this->db_name`");
		self::DBquery("CREATE DATABASE `$this->db_name`");
		echo'Create database '.$this->db_name .PHP_EOL;
	}

	function __construct(){
		self::create_DB();
		self::DBquery("USE `$this->db_name`");
		echo 'Connect to database '.$this->db_name .PHP_EOL;
		self::tables();
		$this->conn = NULL;
	}
}


new db_setup();

?>