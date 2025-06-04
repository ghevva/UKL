<?php
include '../config.php';

$id = $_GET['id_mapel'];
$result = $conn->query("SELECT * FROM mapel WHERE id_mapel=$id");
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama_mapel'];

    $conn->query("UPDATE mapel SET nama_mapel='$nama' WHERE id_mapel=$id");
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
            <input type="hidden" name="id_mapel" value="<?= $user['id_mapel'] ?>">
            <label for="nama_mapel">Mapel</label>
            <input type="text" name="nama_mapel" value="<?= $user['nama_mapel'] ?>" required>
            <button type="submit">Update</button>
        </form>
    </div>
</body>

</html>