<?php
include '../config.php';

    $query_mysql = mysqli_query($conn, "SELECT guru.nama, kelas.nama_kelas, kelas.jumlah_siswa, kelas.id_kelas
    FROM kelas
    JOIN guru ON kelas.id_guru = guru.id_guru
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
    <h1>Data Kelas</h1>
    <a href="create.php">Tambah Data</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Kelas</th>
            <th>Wali Kelas</th>
            <th>Jumlah Siswa</th>
            <th>Aksi</th>
        </tr>
        <?php
        while($row = mysqli_fetch_array($query_mysql)) { 
        ?>
        <tr>
            <td><?php echo $row['id_kelas']; ?></td>
            <td><?php echo $row['nama_kelas']; ?></td>
            <td><?php echo $row['nama']; ?></td>
            <td><?php echo $row['jumlah_siswa']; ?></td>
            <td>
                <a href="edit.php?id_kelas=<?php echo $row['id_kelas']; ?>">Edit</a>
                <a href="delete.php?id_kelas=<?php echo $row['id_kelas']; ?>">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    </div>
</body>
</html>