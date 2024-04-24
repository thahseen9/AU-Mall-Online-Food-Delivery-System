<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$host = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'NetworkProject';
$port = 3307;

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
