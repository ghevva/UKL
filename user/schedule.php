<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'school_life';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

function getJadwalPelajaran($pdo, $kelas_filter = null, $hari_filter = null) {
    $sql = "SELECT kelas.nama_kelas, guru.nama, mapel.nama_mapel, jadwal_pelajaran.waktu, jadwal_pelajaran.hari, jadwal_pelajaran.id_jadwal_pelajaran
    FROM jadwal_pelajaran
    JOIN kelas ON jadwal_pelajaran.id_kelas = kelas.id_kelas
    JOIN guru ON jadwal_pelajaran.id_guru = guru.id_guru
    JOIN mapel ON jadwal_pelajaran.id_mapel = mapel.id_mapel
    " or die(mysqli_error($conn));

    $params = [];
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$kelas_filter = isset($_GET['id_kelas']) ? $_GET['id_kelas'] : null;
$hari_filter = isset($_GET['hari']) ? $_GET['hari'] : null;

$jadwal = getJadwalPelajaran($pdo, $kelas_filter, $hari_filter);
$hari_list = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/school_life.css">
    <link rel="stylesheet" href="css/schedule.css">
</head>
<body>
    <hr>
    
    <header>
        <input type="checkbox" name="" id="toggler">
        <label for="toggler" class="fas fa-bars"></label>
    
        <a href="#" class="logo">SchoolLife<span>.</span></a>    
      
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
    <div class="container">
        <h1 class="heading"> 📚 Jadwal <span>Pelajaran</h1>

        <div class="content">
            <div class="stats">
                <div class="stat-card">
                    <div class="stat-number"><?= count(array_unique(array_column($jadwal, 'nama_kelas'))) ?></div>
                    <div class="stat-label">Kelas Aktif</div>
                </div>
            </div>
                
                <div id="table-view">
                    <table class="jadwal-table">
                        <thead>
                            <tr>
                                <th>Hari</th>
                                <th>Waktu</th>
                                <th>Mata Pelajaran</th>
                                <th>Kelas</th>
                                <th>Guru</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($jadwal as $row): ?>
                                <tr>
                                    <td>
                                        <span class="hari-badge <?= strtolower($row['hari']) ?>">
                                            <?= htmlspecialchars($row['hari']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="waktu"><?= htmlspecialchars($row['waktu']) ?></span>
                                    </td>
                                    <td>
                                        <strong><?= htmlspecialchars($row['nama_mapel']) ?></strong>
                                    </td>
                                    <td>
                                        <span class="kelas"><?= htmlspecialchars($row['nama_kelas']) ?></span>
                                    </td>
                                    <td>
                                        <span class="guru"><?= htmlspecialchars($row['nama']) ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php ?>
        </div>
    </div>

    <script>
        function showView(viewType) {
            const tableView = document.getElementById('table-view');

            if (viewType === 'table') {
                cardView.style.display = 'none';
                tableView.style.display = 'block';
                buttons[1].classList.add('active');
            }
        }
    </script>
    <br>
    <br>
    <br>
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