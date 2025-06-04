<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];

    $conn->query("INSERT INTO guru (id_kelas, nama) VALUES ('$nama')");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../createe.css">
    <title>Tambah Data</title>
</head>
<body>
    <div class="container">
        <h1>Tambah Data</h1>
        <form method="POST">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" required>
            <br>
            <button type="submit">Simpan</button>
        </form>
    </div>
</body>
</html>