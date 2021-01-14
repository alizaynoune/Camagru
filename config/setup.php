<?php
include './database.php';

$conn = new mysqli($DB_DNS, $DB_USER, $DB_PASSWORD);
// Check Connection
if ($conn->connect_error){
	die("connection failed: " . $conn->connect_error);
}

// Create new Database
$sql = "CREATE DATABASE Camagru";
if ($conn->query($sql) === TRUE){
	echo "database has ben created";
}
else {
	echo "error";
}

$conn->close();
?>
