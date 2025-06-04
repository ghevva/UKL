<?php
include '../config.php';
$id = $_GET['id_user'];

$conn->query("DELETE FROM user WHERE id_user=$id");

header("Location: index.php");
exit;
?>