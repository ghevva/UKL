<?php
include '../config.php';

$id = $_GET['id_kelas'];
$result = $conn->query("SELECT * FROM kelas WHERE id_kelas=$id");
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kelas = $_POST['nama_kelas'];
    $jumlah = $_POST['jumlah_siswa'];

    $conn->query("UPDATE kelas SET nama_kelas='$kelas', jumlah_siswa='$jumlah' WHERE id_kelas=$id");
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
            <input type="hidden" name="id_kelas" value="<?= $user['id_kelas'] ?>">
            <label for="nama_kelas">Kelas</label>
            <input type="text" name="nama_kelas" value="<?= $user['nama_kelas'] ?>" required>
            <label for="id_guru">Wali Kelas</label>
            <select name="id_guru" required>
                <option value=""></option>
                <?php
                $guru = $conn->query("SELECT id_guru, nama FROM guru");
                while ($w = $guru->fetch_assoc()) {
                    echo "<option value='{$w['id_guru']}'>{$w['nama']}</option>";
                }
                ?>
            </select>
            <label for="jumlah_siswa">Jumlah Siswa</label>
            <input type="text" name="jumlah_siswa" value="<?= $user['jumlah_siswa'] ?>" required>
            <button type="submit">Update</button>
        </form>
    </div>
</body>

</html>