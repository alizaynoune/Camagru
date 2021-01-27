<?php

class DBClass {
	private		$DB_DNS;
	private		$DB_USER;
	private		$DB_PASSWORD;
	protected	$DB_NAME;
	protected	$DB_CONN;
	protected	$OPTIONS;

	private function Connect_init(){
		$this->DB_DNS = '127.0.0.1';
		$this->DB_USER = 'Camagru1337';
		$this->DB_PASSWORD = 'ali';
		$this->DB_NAME = 'Camagru';
		$this->DB_CONN = NULL;
		$this->OPTIONS = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_CASE => PDO::CASE_NATURAL,
			PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING
		];
	}
	protected	function Connect(){
		self::Connect_init();
		try {
			$this->DB_CONN = new PDO("mysql:host=".$this->DB_DNS, $this->DB_USER, $this->DB_PASSWORD, $this->OPTIONS);
		}catch(PDOException $e){
			die('Database Connection failed: ' . $e->getMessage());
			exit(false);
		}
		return(true);
	}

	protected	function Connect_use(){
		self::Connect_init();
		try {
			$this->DB_CONN = new PDO("mysql:host=".$this->DB_DNS.';dbname='.$this->DB_NAME, $this->DB_USER, $this->DB_PASSWORD, $this->OPTIONS);
		}catch(PDOException $e){
			die('Database Connection failed: ' . $e->getMessage());
			exit(false);
		}
		return(true);
	}
	protected function	Desconnect(){
		unset($this->DB_CONN);
	}
}




?>