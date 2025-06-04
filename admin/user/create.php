<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $conn->query("INSERT INTO user (nama, username, password) VALUES ('$nama', '$username', '$password')");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../createe.css">
    <title>Tambah User</title>
</head>
<body>
    <div class="container">
        <h1>Tambah Data</h1>
        <form method="POST">
            <label for="nama">Name:</label>
            <input type="text" name="nama" required>
            <br>
            <label for="username">Username:</label>
            <input type="text" name="username" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <br>
            <button type="submit">Simpan</button>
        </form>
    </div>
</body>
</html>