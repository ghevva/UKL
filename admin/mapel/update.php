<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id_mapel'];
    $nama = $_POST['nama_mapel'];

    $conn->query("UPDATE mapel SET nama_mapel='$nama' WHERE id_mapel=$id");
}

header("Location: index.php");
exit;
?>