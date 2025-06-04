<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id_user'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn->query("UPDATE user SET nama='$nama', username='$username', password='$password' WHERE id_user=$id");
}

header("Location: index.php");
exit;
?>