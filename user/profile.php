<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil User</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/profil.css">

    
    <link rel="stylesheet" href="https://unpkg.com/boxicon@latest/css/boxicons.min.css">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Paytone+One&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>

    <header>
        <a href="#" class="logo">SchoolLife<span>.</span></a>    
        <div class="bx bx-menu" id="menu-icon"></div>

        <nav class="navbar">
            <a href="SchoolLife.php">home</a>
            <a href="SchoolLife.php #about">about</a>
            <a href="SchoolLife.php #school rules">school rules</a>
            <a href="schedule.php">schedule</a>
            <a href="SchoolLife.php #e-learning">e-learning</a>
            <a href="profile.php">profile</a>
        </nav>
    </header>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <h1 class="heading"> <span> profil </span>user</h1>

    <section class="profile">
        <?php
        session_start();
        if (!isset($_SESSION['username'])) {
         header("Location:login.php");
            exit();
        }
    
        include 'koneksi.php';
        $username = strval($_SESSION['username']);
        $query_mysql = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'") or die (mysqli_error($koneksi));
        if ($data = mysqli_fetch_array($query_mysql)) {

        ?>
        <table border="1" class="table">
            <tr>
                <th>Nama</th>
                <td><?php echo $data['nama']; ?></td>
            </tr>
            <tr>
                <th>Username</th>
                <td><?php echo $data['username']; ?></td>
            </tr>
            <tr>
                <th>Password</th>
                <td><?php echo $data['password']; ?></td>
            </tr>
        </table>
        <br>
        <a href="update.php?id_user=<?php echo $data['id_user']; ?>" class="btn-edit">Edit Profil</a>
        <a href="logout.php" class="btn-logout">Log Out</a>
        <br>
        <?php }
        ?>
    </section>

    <section class="footer">

        <div class="box-container">
      

            <div class="box">
                <h3>quick links</h3>
                <a href="#home">home</a>
                <a href="#about">about</a>
                <a href="#school rules">school rules</a>
                <a href="schedule.php">schedule</a>
                <a href="#e-learning">e-learning</a>
                <a href="profile.php">profile</a>
            </div>

            <div class="box">
                <h3>contact info</h3>
                <a href="#">+62 823-3666-4466</a>
                <a href="https://www.instagram.com/smktelkomsda?igsh=MTVnMTg0djJ2aG1nNw==">@smktelkomsda</a>
                <a href="https://g.co/kgs/tTm1RtT">Jl.Pecantingan, Sekardangan Indah, Sekardangan, Kec.Sidoarjo, Kabupaten Sidoarjo, Jawa Timur</a>
                <a href="https://mail.google.com/mail/u/0/?tf=cm&fs=1&to=smktelkomsda@gmail.com">Get in touch in smktelkomsda@gmail.com </a>
                <a href="https://ppdb.smktelkom-sda.sch.id/">PPDB SMK Telkom Sidoarjo</a>
                <a href="https://mail.google.com/mail/u/0/?tf=cm&fs=1&to=nurwandaghefarah@gmail.com">Get in touch in nurwandaghefarah@gmail.com </a>
            </div>

        </div>

    </section>

</body>
</html>