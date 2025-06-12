<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'school_life';

try {
    $mysqli = new mysqli($host, $username, $password, $database);
    
    if ($mysqli->connect_error) {
        die("Koneksi gagal: " . $mysqli->connect_error);
    }

    $mysqli->set_charset("utf8");
} catch(Exception $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

function getJadwalPelajaran($mysqli, $kelas_filter, $hari_filter) {
    $sql = "SELECT kelas.nama_kelas, guru.nama, mapel.nama_mapel, jadwal_pelajaran.waktu, jadwal_pelajaran.hari, jadwal_pelajaran.id_jadwal_pelajaran
    FROM jadwal_pelajaran
    JOIN kelas ON jadwal_pelajaran.id_kelas = kelas.id_kelas
    JOIN guru ON jadwal_pelajaran.id_guru = guru.id_guru
    JOIN mapel ON jadwal_pelajaran.id_mapel = mapel.id_mapel";

    $conditions = [];
    $params = [];
    $types = "";

    if (!empty($kelas_filter)) {
        $conditions[] = "kelas.id_kelas = ?";
        $params[] = $kelas_filter;
        $types .= "i";
    }

    if (!empty($hari_filter)) {
        $conditions[] = "jadwal_pelajaran.hari = ?";
        $params[] = $hari_filter;
        $types .= "s";
    }

    if (!empty($conditions)) {
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }

    $sql .= " ORDER BY FIELD(jadwal_pelajaran.hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'), jadwal_pelajaran.waktu";

    $stmt = $mysqli->prepare($sql);
    
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    
    if (!$stmt->execute()) {
        die("Execute gagal: " . $stmt->error);
    }
    
    $result = $stmt->get_result();
    $data = [];
    
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    
    $stmt->close();
    return $data;
}

function getKelasList($mysqli) {
    $sql = "SELECT id_kelas, nama_kelas FROM kelas ORDER BY nama_kelas";
    $result = $mysqli->query($sql);
    $kelas = [];
    while ($row = $result->fetch_assoc()) {
        $kelas[] = $row;
    }
    return $kelas;
}

$kelas_filter = isset($_GET['id_kelas']) ? $_GET['id_kelas'] : null;
$hari_filter = isset($_GET['hari']) ? $_GET['hari'] : null;

$jadwal = getJadwalPelajaran($mysqli, $kelas_filter, $hari_filter);
$kelas_list = getKelasList($mysqli);

$hari_list = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/schedulee.css">
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
        <h1 class="heading"> 📚 Jadwal <span>Pelajaran</span></h1>

        <div class="filter-container">
            <form method="GET" action="">
                <div class="filter-row">
                    <div class="filter-group">
                        <label for="id_kelas">Kelas:</label>
                        <select name="id_kelas" id="id_kelas">
                            <option value="">-- Semua Kelas --</option>
                            <?php foreach ($kelas_list as $kelas): ?>
                                <option value="<?= $kelas['id_kelas'] ?>" 
                                        <?= ($kelas_filter == $kelas['id_kelas']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($kelas['nama_kelas']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="hari">Hari:</label>
                        <select name="hari" id="hari">
                            <option value="">-- Semua Hari --</option>
                            <?php foreach ($hari_list as $hari): ?>
                                <option value="<?= $hari ?>" 
                                        <?= ($hari_filter == $hari) ? 'selected' : '' ?>>
                                    <?= $hari ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="filter-buttons">
                        <a href="schedule.php" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
                
                <?php if (!empty($kelas_filter) || !empty($hari_filter)): ?>
                    <div class="active-filters">
                        <strong>Filter Aktif:</strong>
                        <?php if (!empty($kelas_filter)): ?>
                            <?php 
                            $selected_kelas = array_filter($kelas_list, function($k) use ($kelas_filter) {
                                return $k['id_kelas'] == $kelas_filter;
                            });
                            $selected_kelas = reset($selected_kelas);
                            ?>
                            <span class="filter-tag">
                                Kelas: <?= htmlspecialchars($selected_kelas['nama_kelas']) ?>
                                <span class="remove" onclick="removeFilter('id_kelas')"></span>
                            </span>
                        <?php endif; ?>
                        
                        <?php if (!empty($hari_filter)): ?>
                            <span class="filter-tag">
                                Hari: <?= htmlspecialchars($hari_filter) ?>
                                <span class="remove" onclick="removeFilter('hari')"></span>
                            </span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </form>
        </div>

        <div class="content">
                
            <div id="table-view">
                <?php if (empty($jadwal)): ?>
                    <div style="text-align: center; padding: 40px; background: #f8f9fa; border-radius: 10px;">
                        <h3>Tidak ada jadwal yang ditemukan</h3>
                        <p>Coba ubah filter atau <a href="schedule.php">reset filter</a> untuk melihat semua jadwal.</p>
                    </div>
                <?php else: ?>
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
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        function removeFilter(filterType) {
            const url = new URL(window.location.href);
            url.searchParams.delete(filterType);
            window.location.href = url.toString();
        }
        
        document.getElementById('id_kelas').addEventListener('change', function() {
            this.form.submit();
        });
        
        document.getElementById('hari').addEventListener('change', function() {
            this.form.submit();
        });
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