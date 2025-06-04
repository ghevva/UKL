<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kelas = $_POST['id_kelas'];
    $waktu = $_POST['waktu'];
    $mapel = $_POST['id_mapel'];
    $hari = $_POST['hari'];
    $guru = $_POST['id_guru'];

    $conn->query("INSERT INTO jadwal_pelajaran (id_kelas, waktu, id_mapel, hari, id_guru) VALUES ('$kelas', '$waktu', '$mapel', '$hari', '$guru')");
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
            <label for="id_kelas">Kelas:</label>
            <select name="id_kelas" required>
                <option value=""></option>
                <?php
                $kelas = $conn->query("SELECT id_kelas, nama_kelas FROM kelas");
                while ($w = $kelas->fetch_assoc()) {
                    echo "<option value='{$w['id_kelas']}'>{$w['nama_kelas']}</option>";
                }
                ?>
            </select>
            <br>
            <label for="waktu">Waktu:</label>
            <input type="text" name="waktu" required>
            <br>
            <label for="id_mapel">Mapel:</label>
            <select name="id_mapel" required>
                <option value=""></option>
                <?php
                $mapel = $conn->query("SELECT id_mapel, nama_mapel FROM mapel");
                while ($w = $mapel->fetch_assoc()) {
                    echo "<option value='{$w['id_mapel']}'>{$w['nama_mapel']}</option>";
                }
                ?>
            </select>
            <br>
            <label for="hari">Hari:</label>
            <input type="text" name="hari" required>
            <br>
            <label for="id_guru">Guru:</label>
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
            <button type="submit">Simpan</button>
        </form>
    </div>
</body>
</html>