<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kelas = $_POST['nama_kelas'];
    $walas = $_POST['id_guru'];
    $jumlah = $_POST['jumlah_siswa'];

    $conn->query("INSERT INTO kelas (nama_kelas, id_guru, jumlah_siswa) VALUES ('$kelas', '$walas', '$jumlah')");
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
            <label for="nama_kelas">Kelas:</label>
            <input type="text" name="nama_kelas" required>
            <br>
            <label for="id_guru">Wali Kelas:</label>
            <select name="id_guru" required>
                <option value=""></option>
                <?php
                $guru = $conn->query("SELECT id_guru, nama FROM guru");
                while ($w = $guru->fetch_assoc()) {
                    echo "<option value='{$w['id_guru']}'>{$w['nama']}</option>";
                }
                ?>
            </select>
            <br>
            <label for="jumlah_siswa">Jumlah Siswa:</label>
            <input type="text" name="jumlah_siswa" required>
            <br>
            <button type="submit">Simpan</button>
        </form>
    </div>
</body>
</html>