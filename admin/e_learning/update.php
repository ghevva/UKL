<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id_e_learning'];
    $judul = $_POST['judul'];
    $url = $_POST['url'];

    $conn->query("UPDATE e_learning SET judul='$judul', url='$url' WHERE id_e_learning=$id");
}

header("Location: index.php");
exit;
?>