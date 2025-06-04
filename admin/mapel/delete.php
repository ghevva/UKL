<?php
include '../config.php';
$id = $_GET['id_mapel'];

$conn->query("DELETE FROM mapel WHERE id_mapel=$id");

header("Location: index.php");
exit;
?>