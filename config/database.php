<?php
	$DB_DNS = 'mysql:host=127.0.0.1';
	$DB_USER = 'Camagru1337';
	$DB_PASSWORD = 'ali';

class DB_CONNECT {
	protected	$DB_SERVER;
	protected	$DB_DNS;
	protected	$DB_USER;
	protected	$DB_PASSWORD;
	protected	$DB_NAME;

	public function __construct(){
		$this->DB_SERVER = 'mysql';
		$this->DB_DNS = '127.0.0.1';
		$this->DB_USER = 'Camagru1337';
		$this->DB_PASSWORD = 'ali';
		$this->DB_NAME = 'Camagru';
	}
}
?>
