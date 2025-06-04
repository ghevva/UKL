<?php
include '../config.php';

$id = $_GET['id_user'];
$result = $conn->query("SELECT * FROM user WHERE id_user=$id");
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $conn->query("UPDATE user SET nama='$nama', username='$username', password='$password' WHERE id_user=$id");
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
            <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
            <label for="nama">Nama</label>
            <input type="text" name="nama" value="<?= $user['nama'] ?>" required>
            <label for="username">Username</label>
            <input type="text" name="username" value="<?= $user['username'] ?>" required>
            <label for="password">Password</label>
            <input type="password" name="password" value="<?= $user['password'] ?>" required>
            <button type="submit">Update</button>
        </form>
    </div>
</body>

</html>