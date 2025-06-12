<?php
include '../config.php';

$id = $_GET['id_e_learning'];
$result = $conn->query("SELECT * FROM e_learning WHERE id_e_learning=$id");
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mapel = $_POST['id_mapel'];
    $judul = $_POST['judul'];
    $url = $_POST['url'];

    $conn->query("UPDATE e_learning SET id_mapel='$mapel', judul='$judul', url='$url' WHERE id_e_learning=$id");
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
            <input type="hidden" name="id_e_learning" value="<?= $user['id_e_learning'] ?>">
            <label for="judul">Judul</label>
            <input type="text" name="judul" value="<?= $user['judul'] ?>" required>
            <label for="url">Url</label>
            <input type="url" name="url" value="<?= $user['url'] ?>" required>
            <button type="submit">Update</button>
        </form>
    </div>
</body>

</html>