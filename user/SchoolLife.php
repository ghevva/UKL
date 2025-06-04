<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/school_life.css">
</head>
<body>
  <hr>

  <header>

    <input type="checkbox" name="" id="toggler">
    <label for="toggler" class="fas fa-bars"></label>
    
    <a href="#" class="logo">SchoolLife<span>.</span></a>    
      
    <nav class="navbar">
      <a href="#home">home</a>
      <a href="#about">about</a>
      <a href="#school rules">school rules</a>
      <a href="schedule.php">schedule</a>
      <a href="#e-learning">e-learning</a>
      <a href="profile.php">profile</a>
    </nav>

  </header>
    
  <section class="home" id="home">
    
    <main class="content">
      <h3>SchoolLife</h3>
      <span> Easy school, easy life </span>
      <a href="#about" class="btn">check it out!</a>
    </main>
    
  </section>
  <!--Ends-->

  <!--About Section Starts-->
  
  <section class="about" id="about">

    <h1 class="heading"> <span> about </span>us</h1>

    <div class="row">

      <div class="image-container">
        <image src="TelkomSda.jpeg" width="500"></image>
        <h3>Sekolah berbasis Teknologi</h3>
      </div>

      <div class="content">
        <h3>Why choose us?</h3>
        <p>SMK Telkom Sidoarjo sudah terakreditasi A, dengan guru pengajar dan lingkungan yang ramah anak.</p>
        <p>Fasilitas di sekolah ini sudah lengkap termasuk dengan lab komputer, aula, ruang IoT dan sebagainya.</p>
        <a href="#school rules" class="btn">Learn More</a>
      </div>

    </div>

  </section>

<!--Home Secton Ends-->

<!--school rules section starts-->

  <section class="schoolrules" id="school rules">

    <h1 class="heading"> School <span>Rules</h1>

    <div class="content">
      <p>1. Datang tepat waktu (06.30) dan tidak terlambat.</p>
      <p>2. Menggunakan atribut lengkap sesuai hari.</p>
      <p>3. Menggunakan sepatu pantofel di hari senin dan jumat.</p>
      <p>4. Menggunakan sepatu bebas hitam di hari selasa dan kamis.</p>
      <p>5. Menggunakan sepatu bebas di hari rabu.</p>
      <p>6. Tidak menggunakan perhiasan selain jam tangan.</p>
      <p>7. Potongan rambut 321 (siswa).</p>
      <p>8. Mengikat rambut (siswi yang tidak berhijab).</p>
      <p>9. Tidak membawa make-up.</p>
      <p>10. Menggunakan seragam sesuai jadwal.</p>
    </div>

  </section>
<!--school rules section ends-->

<!--schedule section starts-->

<!--schedule section ends-->

<!-- e-learning section starts-->
  <section class="e-learning" id="e-learning">
    <link rel="stylesheet" href="css/e_learning.css">
    <h1 class="heading"> <span> e- </span>learning</h1>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "school_life";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Koneksi gagal: " . $conn->connect_error);
    }

    $sql = "SELECT judul, url FROM e_learning";
    $result = $conn->query($sql);

    function getYoutubeEmbedUrl($url) {
    if (preg_match('/youtu\.be\/([^\?\/]+)/', $url, $matches)) {
      return 'https://www.youtube.com/embed/' . $matches[1];
    } elseif (preg_match('/v=([^\&]+)/', $url, $matches)) {
      return 'https://www.youtube.com/embed/' . $matches[1];
    }
    return null;
    }

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $embedUrl = getYoutubeEmbedUrl($row['url']);
        if ($embedUrl) {
          echo "<div class='video-card'>";
          echo "<h2>" . htmlspecialchars($row['judul']) . "</h2>";
          echo "<iframe src='" . htmlspecialchars($embedUrl) . "' allowfullscreen></iframe>";
          echo "</div>";
        }
      }
    } else {
      echo "<p>Tidak ada video.</p>";
    }

    $conn->close();
    ?>

  </section>
<!--e-learning section ends>-->

<!--footer section starts-->

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

<!--footer section ends-->
</body>
</html>