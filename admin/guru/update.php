<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id_guru'];
    $nama = $_POST['nama'];

    $conn->query("UPDATE guru SET nama='$nama' WHERE id_guru=$id");
}

header("Location: index.php");
exit;
?>