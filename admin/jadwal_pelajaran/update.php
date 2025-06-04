<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id_jadwal_pelajaran'];
    $kelas = $_POST['id_kelas'];
    $waktu = $_POST['waktu'];
    $mapel = $_POST['id_mapel'];
    $hari = $_POST['hari'];
    $guru = $_POST['id_guru'];

    $conn->query("UPDATE jadwal_pelajaran SET id_kelas='$kelas', waktu='$waktu', id_mapel='$mapel', hari='$hari', id_guru='$guru' WHERE id_jadwal_pelajaran=$id");
}

header("Location: index.php");
exit;
?>