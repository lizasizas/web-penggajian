
<?php
session_start(); 
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "zenithsalary";

$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
?>
<head>
  <title>Riwayat Pengajuan | ZenithSalary</title>
</head>
<?php include 'header.php';?>

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">

<div class="container">
  <div class="row">
    <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
      <div data-aos="fade-up" data-aos-delay="800">
      <h1  class="animated fadeInDown">Riwayat Pengajuan</h1>
                <p class="animated fadeInUp">silah pilih informasi dibawah ini</p> 
  
                <div>
                <a href="riwayat_potongan.php" class="btn-get-started scrollto">Pengajuan Potongan</a>
                <a href="riwayat_tunjangan.php" class="btn-get-started scrollto">Pengajuan Tunjangan</a>
                </div> 
      </div>
    </div>
    <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left" data-aos-delay="200">
      <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
    </div>
  </div>
</div>

</section><!-- End Hero -->
<!-- banner -->

<!-- banner-->

