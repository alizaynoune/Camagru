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
}

class	DB_execute extends DBClass{
	public		$RSLT;
	private		$STM;

	public function	CMDexecute($name){
		parent::Connect();
		$this->STM = $this->DB_CONN->prepare($name);
		$this->STM->execute([$name]);
		$this->RSLT = $this->STM->fetchAll(PDO::FETCH_NUM);
		$this->DB_CONN = NULL;
		return($this->RSLT);
	}
}

class	DB_Exists extends DB_execute{
	private		$STM;

	private function		if_Exists(){
		parent::Connect();
		$this->STM = $this->DB_CONN->prepare("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '".$this->DB_NAME . "'");
		$this->STM->execute();
		$this->DB_CONN = NULL;
		if ($this->STM->fetchColumn() > 0)
			return (true);
		else
			return (false);
	}

	public	function	DB_USE(){
		if (self::if_Exists() === true){
			return (true);
		}
		else
			return (false);
	}

}

class	Table_Exists extends DB_Exists{

}

// class	DB_Creat extends DBClass{

// }

class	Table_Creat extends DBClass{

}

class	DB_Drop extends DBClass{

}

class	Table_Drop extends DBClass{

}


?>