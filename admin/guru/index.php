<?php
include '../config.php';

$result = $conn->query("SELECT * FROM guru");
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
    <h1>Data Guru</h1>
    <a href="create.php">Tambah Data</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id_guru']; ?></td>
            <td><?php echo $row['nama']; ?></td>
            <td>
                <a href="edit.php?id_guru=<?php echo $row['id_guru']; ?>">Edit</a>
                <a href="delete.php?id_guru=<?php echo $row['id_guru']; ?>">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    </div>
</body>
</html>