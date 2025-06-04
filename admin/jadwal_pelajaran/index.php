<?php
include '../config.php';

    $query_mysql = mysqli_query($conn, "SELECT kelas.nama_kelas, guru.nama, mapel.nama_mapel, jadwal_pelajaran.waktu, jadwal_pelajaran.hari, jadwal_pelajaran.id_jadwal_pelajaran
    FROM jadwal_pelajaran
    JOIN kelas ON jadwal_pelajaran.id_kelas = kelas.id_kelas
    JOIN guru ON jadwal_pelajaran.id_guru = guru.id_guru
    JOIN mapel ON jadwal_pelajaran.id_mapel = mapel.id_mapel
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
    <h1>Jadwal Pelajaran</h1>
    <a href="create.php">Tambah Data</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Kelas</th>
            <th>Waktu</th>
            <th>Mapel</th>
            <th>Hari</th>
            <th>Guru</th>
            <th>Aksi</th>
        </tr>
<?php
    while($row = mysqli_fetch_array($query_mysql)) { 
    ?>
        <tr>
            <td><?php echo $row['id_jadwal_pelajaran']; ?></td>
            <td><?php echo $row['nama_kelas']; ?></td>
            <td><?php echo $row['waktu']; ?></td>
            <td><?php echo $row['nama_mapel']; ?></td>
            <td><?php echo $row['hari']; ?></td>
            <td><?php echo $row['nama']; ?></td>
            <td>
                <a href="edit.php?id_jadwal_pelajaran=<?php echo $row['id_jadwal_pelajaran']; ?>">Edit</a>
                <a href="delete.php?id_jadwal_pelajaran=<?php echo $row['id_jadwal_pelajaran']; ?>">Hapus</a>
            </td>
        </tr>
    <?php } ?>
    </table>
    
    </div>
</body>
</html>