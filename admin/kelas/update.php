<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id_kelas'];
    $kelas = $_POST['nama_kelas'];
    $walas = $_POST['id_guru'];
    $jumlah = $_POST['jumlah_siswa'];

    $conn->query("UPDATE kelas SET nama_kelas='$kelas', id_guru='$walas', jumlah_siswa='$jumlah' WHERE id_kelas=$id");
}

header("Location: index.php");
exit;
?>