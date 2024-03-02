<?php
session_start(); 
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "zenithsalary";

$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
?>

<?php include ('header.php');?>

<!-- banner -->
<div class="banner">           
    <img src="images/photos/banner.jpg"  class="img-responsive" alt="slide">
    <div class="welcome-message">
        <div class="wrap-info">
            <div class="information">
                <h1  class="animated fadeInDown">Informasi Riwayat Pengajuan</h1>
                <p class="animated fadeInUp">silah pilih informasi dibawah ini</p> 
                <a href="riwayat_potongan.php" class="btn btn-primary">Riwayat Pengajuan Potongan</a>
                <a href="riwayat_tunjangan.php" class="btn btn-primary">Riwayat Pengajuan Tunjangan</a>                   
            </div>
        </div>
    </div>
</div>
<!-- banner-->
