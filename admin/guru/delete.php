<?php
include '../config.php';
$id = $_GET['id_guru'];

$conn->query("DELETE FROM guru WHERE id_guru=$id");

header("Location: index.php");
exit;
?>