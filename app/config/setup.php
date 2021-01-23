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
		self::DB_EXEC($ARRAY["_table"]._users_.' ( id '.$ARRAY["_aid"].', login '.$ARRAY["_login"].' , active '.$ARRAY["_true_false"].' , dateCreate '.$ARRAY["_date"].')');
		self::DB_EXEC($ARRAY["_table"]._usersinfo_.' ( uid '.$ARRAY["_id"].' , photid '. $ARRAY["_id_0"]. ' , firstname '.$ARRAY["_name"].' , lastname '. $ARRAY["_name"]. ' , '.$ARRAY["_email"].')');
		self::DB_EXEC($ARRAY["_table"]._passwd_. ' ( uid '.$ARRAY["_id"]. ' , '. $ARRAY["_pwd"].')');
		self::DB_EXEC($ARRAY["_table"]._posts_. ' ( pid '.$ARRAY["_aid"] . ' , uid ' . $ARRAY['_id'] . ' , pLink ' . $ARRAY['_string'] . ' , likes ' . $ARRAY['_id_0'] . ' , dateCreate ' . $ARRAY['_date'] .')');
		self::DB_EXEC($ARRAY["_table"]._comment_. '( cid '.$ARRAY['_aid'] . ' , uid ' . $ARRAY['_id'] . ' , pid ' . $ARRAY['_id'] . ' , Comment ' . $ARRAY['_comment'] . ' , likes '. $ARRAY['_id_0'] .' , dateCreate ' . $ARRAY['_date'] .')');
		self::DB_EXEC($ARRAY["_table"]._Plike_. '( like_id '. $ARRAY['_aid'] . ' , post_id '. $ARRAY['_id'] . ' , uid ' . $ARRAY['_id'] . ' , dateCreate ' . $ARRAY['_date'] .')');
		self::DB_EXEC($ARRAY["_table"]._Clike_. '( like_id '. $ARRAY['_aid'] . ' , comment_id '. $ARRAY['_id'] . ' , uid ' . $ARRAY['_id'] . ' , dateCreate ' . $ARRAY['_date'] .')');

	}
}


$test = new DB_SETUP();
echo $test->create_TB($DB_CREATE);
// print_r ($DB_CREATE);

?>