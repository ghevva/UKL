<?php
include '../config.php';
$id = $_GET['id_kelas'];

$conn->query("DELETE FROM kelas WHERE id_kelas=$id");

header("Location: index.php");
exit;
?>