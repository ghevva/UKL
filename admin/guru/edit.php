<?php
include '../config.php';

$id = $_GET['id_guru'];
$result = $conn->query("SELECT * FROM guru WHERE id_guru=$id");
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];

    $conn->query("UPDATE guru SET nama='$nama' WHERE id_guru=$id");
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
            <input type="hidden" name="id_guru" value="<?= $user['id_guru'] ?>">
            <label for="nama">Nama</label>
            <input type="text" name="nama" value="<?= $user['nama'] ?>" required>
            <button type="submit">Update</button>
        </form>
    </div>
</body>

</html>