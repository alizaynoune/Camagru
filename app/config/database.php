<?php

class DBClass {
	private		$DB_DNS;
	private		$DB_USER;
	private		$DB_PASSWORD;
	private		$DB_NAME;
	protected	$DB_CONN;

	private function Connect_init(){
		$this->DB_DNS = '127.0.0.1';
		$this->DB_USER = 'Camagru1337';
		$this->DB_PASSWORD = 'ali';
		$this->DB_NAME = 'Camagru';
		$this->DB_CONN = NULL;
	}
	protected	function Connect(){
		$options = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_CASE => PDO::CASE_NATURAL,
			PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING
		];
		$this->Connect_init();
		try {
			$this->DB_CONN = new PDO("mysql:host=".$this->DB_DNS.";dbname=".$this->DB_NAME, $this->DB_USER, $this->DB_PASSWORD, $this->options);
		}catch(PDOException $e){
			die('Database Connection failed: ' . $e->getMessage());
		}
		return($this->DB_CONN);
	}
}

class	DBConnect extends DBClass{
	protected function DB_Connect(){
		$this->Connect();
		return($this->DB_CONN);
	}
}

class	DB_execute extends DBConnect{
	public		$RSLT;
	private		$STM;

	public function	CMDexecute($name){
		$this->DB_Connect();
		$this->STM = $this->DB_CONN->prepare($name);
		$this->STM->execute();
		$this->RSLT = $this->STM->fetchAll(PDO::FETCH_NUM);
		$this->DB_CONN = NULL;
		return($this->RSLT);
	}
}


?>
