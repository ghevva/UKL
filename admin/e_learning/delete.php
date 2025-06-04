<?php
include '../config.php';
$id = $_GET['id_e_learning'];

$conn->query("DELETE FROM e_learning WHERE id_e_learning=$id");

header("Location: index.php");
exit;
?>