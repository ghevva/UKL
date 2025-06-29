<?php
include '../config.php';

    $query_mysql = mysqli_query($conn, "SELECT mapel.nama_mapel, e_learning.judul, e_learning.url, e_learning.id_e_learning
    FROM e_learning
    JOIN mapel ON e_learning.id_mapel = mapel.id_mapel
    ") or die(mysqli_error($conn));

    $nomor = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <title>CRUD App</title>
</head>
<body>
    
    <header>
        <ul class="navbar">
            <a href="/UKL/admin/user/index.php">User</a>
            <a href="/UKL/admin/e_learning/index.php">E-Learning</a>
            <a href="/UKL/admin/guru/index.php">Guru</a>
            <a href="/UKL/admin/mapel/index.php">Mapel</a>
            <a href="/UKL/admin/jadwal_pelajaran/index.php">Jadwal</a>
            <a href="/UKL/admin/kelas/index.php">Kelas</a>
        </ul>
    </header>

    <div class="container">
    <h1>Data E-Learning</h1>
    <a href="create.php">Tambah Link</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Mapel</th>
            <th>Judul</th>
            <th>Url</th>
            <th>Aksi</th>
        </tr>
        <?php
        while($row = mysqli_fetch_array($query_mysql)) {
        ?>
        <tr>
            <td><?php echo $row['id_e_learning']; ?></td>
            <td><?php echo $row['nama_mapel']; ?></td>
            <td><?php echo $row['judul']; ?></td>
            <td><?php echo $row['url']; ?></td>
            <td>
                <a href="edit.php?id_e_learning=<?php echo $row['id_e_learning']; ?>">Edit</a>
                <a href="delete.php?id_e_learning=<?php echo $row['id_e_learning']; ?>">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    </div>
</body>
</html>