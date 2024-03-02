<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "zenithsalary";

$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
session_start();

if(!isset($_SESSION["karyawan"]))
{
  echo "<script>alert('Anda Harus Login Terlebih Dahulu');</script>";
  echo "<script>location='../loginuser/autentikasi.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title> nota </title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<BODY STYLE="BACKGROUND-IMAGE:URL(nota.PNG)">

    <?php include'header.php'?>

<section class="detailslipgaji">
    <div class="container">
    </br>
    </br>
      <center><h3> SLIP GAJI</h3></center>
</br>

<div class="container">
<div class="row">
<?php
  $ambil=$koneksi->query("SELECT * FROM karyawan JOIN golongan on karyawan.id_golongan=golongan.id_golongan WHERE id_karyawan = '$id_karyawan'");
?>