<?php
include 'database.php';
require_once'schimaDefine.php';

class	DB_SETUP extends DBClass{

	private	function DB_EXEC($cmd){
		$this->DB_CONN->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try{
			$this->DB_CONN->exec($cmd);
		} catch(PDOException $e){
			die ("Error : ". $e->getMessage());
		}
	}

	private function create_DB(){
		parent::Connect();
		
		self::DB_EXEC("DROP DATABASE IF EXISTS `$this->DB_NAME`");
		self::DB_EXEC("CREATE DATABASE `$this->DB_NAME`");
	}

	public	function create_TB($ARRAY){
		self::create_DB();
		self::DB_EXEC("USE `$this->DB_NAME`");
		self::DB_EXEC($ARRAY[_table]._users_.'
			( id'.$ARRAY[_aid].','.$ARRAY[_login].','.$ARRAY[_active]
			.','.$ARRAY[_email].')');
		self::DB_EXEC($ARRAY[_table]._usersinfo_.'( idphoto'.
			$ARRAY[_idphoto].', uid'. $ARRAY[_id]. ','.$ARRAY[_firstname].
			','. $ARRAY[_lastname]. ','.$ARRAY[_email].')');
		self::DB_EXEC($ARRAY[_table]._passwd_. '( uid'.$ARRAY[_id]. ','. $ARRAY[_upwd].')');
		// self::DB_EXEC($ARRAY[_table]._posts_. '( pid'.$ARRAY[_aid]. ')');

	}
}


$test = new DB_SETUP();
echo $test->create_TB($DB_CREATE);
// print_r ($DB_CREATE);

?>