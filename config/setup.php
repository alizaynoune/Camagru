<?php
include './database.php';
$test = new DB_CONNECT;
echo $test->DB_DNS;
try {
    $dbh = new PDO($DB_DNS, $DB_USER, $DB_PASSWORD);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
