<?php

include("koneksi.php");

if(isset($_POST['simpan'])){

    $id = $_POST['id_user'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $result = mysqli_query($koneksi,"UPDATE user
    SET nama='$nama',username='$username',password='$password'
    WHERE id_user=$id");
    header('Location: profile.php');
} else {
    die("Akses dilarang...");
}
?>