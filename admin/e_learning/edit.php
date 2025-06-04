<?php
include '../config.php';

$id = $_GET['id_e_learning'];
$result = $conn->query("SELECT * FROM e_learning WHERE id_e_learning=$id");
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $url = $_POST['url'];

    $conn->query("UPDATE e_learning SET judul='$judul', url='$url' WHERE id_e_learning=$id");
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