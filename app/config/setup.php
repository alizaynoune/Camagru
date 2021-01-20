<?php
include './database.php';
$test = new DB_Exists();
if ($test->DB_USE() === true)
	echo "done".PHP_EOL;

?>
