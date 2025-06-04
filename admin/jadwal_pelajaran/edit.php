<?php
include '../config.php';

$id = $_GET['id_jadwal_pelajaran'];
$result = $conn->query("SELECT * FROM jadwal_pelajaran WHERE id_jadwal_pelajaran=$id");
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kelas = $_POST['id_kelas'];
    $waktu = $_POST['waktu'];
    $mapel = $_POST['id_mapel'];
    $hari = $_POST['hari'];
    $guru = $_POST['id_guru'];

    $conn->query("UPDATE jadwal_pelajaran SET id_kelas='$kelas', waktu='$waktu', id_mapel='$mapel', hari='$hari', id_guru='$guru' WHERE id_jadwal_pelajaran=$id");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../edit.css">
    <title>Edit Data</title>
</head>

<body>
    <div class="container">
        <h2>Edit Data</h2>
        <form action="update.php" method="POST">
            <input type="hidden" name="id_jadwal_pelajaran" value="<?= $user['id_jadwal_pelajaran'] ?>">
            <label for="id_kelas">Kelas</label>
            <select name="id_kelas" required
                <option value=""></option>
                <?php
                $kelas = $conn->query("SELECT id_kelas, nama_kelas FROM kelas");
                while ($w = $kelas->fetch_assoc()) {
                    echo "<option value='{$w['id_kelas']}'>{$w['nama_kelas']}</option>";
                }
                ?>
            </select>
            <label for="waktu">Waktu</label>
            <input type="text" name="waktu" value="<?= $user['waktu'] ?>" required>
            <label for="id_mapel">Mapel</label>
            <select name="id_mapel" required
                <option value=""></option>
                <?php
                $mapel = $conn->query("SELECT id_mapel, nama_mapel FROM mapel");
                while ($w = $mapel->fetch_assoc()) {
                    echo "<option value='{$w['id_mapel']}'>{$w['nama_mapel']}</option>";
                }
                ?>
            </select>
            <label for="hari">Hari</label>
            <input type="text" name="hari" value="<?= $user['hari'] ?>" required>
            <label for="id_guru">Guru</label>
            <select name="id_guru" required
                <option value=""></option>
                <?php
                $guru = $conn->query("SELECT id_guru, nama FROM guru");
                while ($w = $guru->fetch_assoc()) {
                    echo "<option value='{$w['id_guru']}'>{$w['nama']}</option>";
                }
                ?>
            </select>
            <button type="submit">Update</button>
        </form>
    </div>
</body>

</html>