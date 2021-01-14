<?php
include './database.php';

try {
    $dbh = new PDO($DB_DNS, $DB_USER, $DB_PASSWORD);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
