<?php
include '../config.php';
$id = $_GET['id_jadwal_pelajaran'];

$conn->query("DELETE FROM jadwal_pelajaran WHERE id_jadwal_pelajaran=$id");

header("Location: index.php");
exit;
?>