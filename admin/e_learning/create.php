<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mapel = $_POST['id_mapel'];
    $judul = $_POST['judul'];
    $url = $_POST['url'];

    $conn->query("INSERT INTO e_learning (judul, url) VALUES ('$mapel', '$judul', '$url')");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../createe.css">
    <title>Tambah Link</title>
</head>
<body>
    <div class="container">
        <h1>Tambah Url</h1>
        <form method="POST">
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
            <label for="judul">Judul:</label>
            <input type="text" name="judul" required>
            <br>
            <label for="url">Url:</label>
            <input type="url" name="url" required>
            <br>
            <button type="submit">Simpan</button>
        </form>
    </div>
</body>
</html>