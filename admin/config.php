<?php
$host = 'localhost';
$user = 'root'; // ganti dengan username database Anda
$password = ''; // ganti dengan password database Anda
$dbname = 'school_life';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>