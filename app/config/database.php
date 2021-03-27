<?php

class db_conn {
	private		$db_dns;
	private		$db_user;
	private		$db_password;
	protected	$db_name;
	protected	$conn;
	protected	$OPTIONS;

	private function Connect_init(){
		$this->db_dns = '127.0.0.1';
		$this->db_user = 'Camagru1337';
		$this->db_password = 'ali';
		$this->db_name = 'Camagru';
		$this->conn = NULL;
		$this->OPTIONS = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_CASE => PDO::CASE_NATURAL,
			PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING
		];
	}
	protected	function Connect(){
		self::Connect_init();
		try {
			$this->conn = new PDO("mysql:host=".$this->db_dns, $this->db_user, $this->db_password, $this->OPTIONS);
		}catch(PDOException $e){
			return(false);
		}
		return(true);
	}

	protected	function Connect_use(){
		self::Connect_init();
		try {
			$this->conn = new PDO("mysql:host=".$this->db_dns.';dbname='.$this->db_name, $this->db_user, $this->db_password, $this->OPTIONS);
		}catch(PDOException $e){
			return(false);
		}
		return(true);
	}
	protected function	Desconnect(){
		$this->conn = null;
		$this->db_dns = null;
		$this->db_user = null;
		$this->db_password = null;
		$this->db_name = null;
	}
}
