<?php
session_start ();
//koneksi ke database
include('config.php');
require_once("ceknota.php");
?>
<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed layout-wide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="assets/"
  data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Admin | ZenithSalary</title>
    <style>
    /* CSS untuk mengubah warna background body */
    body {
      background-color: #3498db; /* Ganti dengan kode warna yang Anda inginkan */
    }
  </style>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />
    

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>
  </head>

  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
          <a href="index.php" class="app-brand-link">
            <img src="assets/img/favicon/favicon.svg" alt="Logo ZenithSalary" class="logo-image">
            <span class="app-brand-text demo menu-text fw-bold ms-2">ZenithSalary</span>
          </a>

          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
          </a>
        </div>
        


          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboards -->
            <li class="menu-item">
              <a href="index.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboards">Dashboards</div>
              </a>
            </li>
            
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Data</span>
            </li>

            <li class="menu-item">
              <a href="index.php?halaman=karyawan" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Karyawan">Karyawan</div>
              </a>
            </li>

            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Data karyawan">Data Karyawan</div>
              </a>
              <ul class="menu-sub">
                
                <li class="menu-item">
                  <a href="index.php?halaman=status_nikah" class="menu-link">
                    <div data-i18n="status_nikah">Status Nikah</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="index.php?halaman=agama" class="menu-link">
                    <div data-i18n="agama">Agama</div>
                  </a>
                </li>
              </ul>
            </li>

            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div data-i18n="Layouts">Status</div>
              </a>
               <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="index.php?halaman=verifikasi" class="menu-link">
                      <div data-i18n="verifikasi">Verifikasi</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="index.php?halaman=status_potongan" class="menu-link">
                      <div data-i18n="status_potongan">Status Potongan</div>
                    </a>
                  </li>
               </ul>
            </li>

            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-briefcase"></i>
                <div data-i18n="Daftar Posisi Karyawan">Posisi Karyawan</div>
              </a>
              <ul class="menu-sub">
               <li class="menu-item">
                  <a href="index.php?halaman=jabatan" class="menu-link">
                    <div data-i18n="Data Jabatan">Data Jabatan</div>
                  </a>
                </li>
                  <li class="menu-item">
                  <a href="index.php?halaman=divisi" class="menu-link">
                    <div data-i18n="Data Divisi">Data Divisi</div>
                  </a>
                </li>
                  <li class="menu-item">
                  <a href="index.php?halaman=golongan" class="menu-link">
                    <div data-i18n="Data Golongan">Data Golongan</div>
                  </a>
                </li>
              </ul>
            </li>

            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Data Tunjangan">Potongan</div>
              </a>
              <ul class="menu-sub">
                 <li class="menu-item">
                  <a href="index.php?halaman=nota_potongan" class="menu-link">
                    <div data-i18n="daftar_Tunjangan Karyawan">Daftar Potongan</div>
                  </a>
                </li>
                 <li class="menu-item">
                  <a href="index.php?halaman=transaksi_potongan" class="menu-link">
                    <div data-i18n="transaksi_Tunjangan Karyawan">Transaksi</div>
                  </a>
                </li>
                  <li class="menu-item">
                  <a href="index.php?halaman=potongan" class="menu-link">
                    <div data-i18n="Jenis Potongan">Jenis Potongan</div>
                  </a>
                </li>
              </ul>
            </li>
            
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Tunjangan</div>
              </a>
               <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="index.php?halaman=nota_tunjangan" class="menu-link">
                      <div data-i18n="Daftar Tunjangan">Daftar Tunjangan</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="index.php?halaman=tunjangan" class="menu-link">
                      <div data-i18n="Tunjangan">Tunjangan</div>
                    </a>
                  </li>
               </ul>
            </li>

            <li class="menu-item">
              <a href="index.php?halaman=slip_gaji" class="menu-link">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="buat_slip">Slip</div>
              </a>
            </li>

            
          <!-- Sidebar Toggler (Sidebar) -->
          
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <?php include('navbar.php');?>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-fluid flex-grow-1 container-p-y">
              <!-- Layout Demo -->
              <?php
              if(isset($_GET['halaman']))
              {
                if ($_GET['halaman']=="karyawan")
                {
                  include 'karyawan.php';
                }
                elseif ($_GET['halaman']=="cari_karyawan")
                {
                  include 'cari_karyawan.php';
                }
                elseif ($_GET['halaman']=="tambah_karyawan")
                {
                  include 'tambah_karyawan.php';
                }
                elseif ($_GET['halaman']=="hapus_karyawan")
                {
                  include 'hapus_karyawan.php';
                }
                elseif ($_GET['halaman']=="ubah_karyawan")
                {
                  include 'ubah_karyawan.php';
                }
                elseif ($_GET['halaman']=="jabatan")
                {
                  include 'jabatan.php';
                }
                elseif ($_GET['halaman']=="cari_jabatan")
                {
                  include 'cari_jabatan.php';
                }
                elseif ($_GET['halaman']=="tambah_jabatan")
                {
                  include 'tambah_jabatan.php';
                }
                elseif ($_GET['halaman']=="hapus_jabatan")
                {
                  include 'hapus_jabatan.php';
                }
                elseif ($_GET['halaman']=="ubah_jabatan")
                {
                  include 'ubah_jabatan.php';
                }
               elseif ($_GET['halaman']=="divisi")
                {
                  include 'divisi.php';
                }
                elseif ($_GET['halaman']=="cari_divisi")
                {
                  include 'cari_divisi.php';
                }
                elseif ($_GET['halaman']=="tambah_divisi")
                {
                  include 'tambah_divisi.php';
                }
                elseif ($_GET['halaman']=="hapus_divisi")
                {
                  include 'hapus_divisi.php';
                }
                elseif ($_GET['halaman']=="ubah_divisi")
                {
                  include 'ubah_divisi.php';
                }
                elseif ($_GET['halaman']=="golongan")
                {
                  include 'golongan.php';
                }
                elseif ($_GET['halaman']=="cari_golongan")
                {
                  include 'cari_golongan.php';
                }
                elseif ($_GET['halaman']=="tambah_golongan")
                {
                  include 'tambah_golongan.php';
                }
                elseif ($_GET['halaman']=="hapus_golongan")
                {
                  include 'hapus_golongan.php';
                }
                elseif ($_GET['halaman']=="ubah_golongan")
                {
                  include 'ubah_golongan.php';
                }
                elseif ($_GET['halaman']=="verifikasi")
                {
                  include 'verifikasi.php';
                }
                elseif ($_GET['halaman']=="cari_verifikasi")
                {
                  include 'cari_verifikasi.php';
                }
                elseif ($_GET['halaman']=="tambah_verifikasi")
                {
                  include 'tambah_verifikasi.php';
                }
                elseif ($_GET['halaman']=="hapus_verifikasi")
                {
                  include 'hapus_verifikasi.php';
                }
                elseif ($_GET['halaman']=="ubah_verifikasi")
                {
                  include 'ubah_verifikasi.php';
                }
                elseif ($_GET['halaman']=="agama")
                {
                  include 'agama.php';
                }
                elseif ($_GET['halaman']=="cari_agama")
                {
                  include 'cari_agama.php';
                }
                elseif ($_GET['halaman']=="tambah_agama")
                {
                  include 'tambah_agama.php';
                }
                elseif ($_GET['halaman']=="hapus_agama")
                {
                  include 'hapus_agama.php';
                }
                elseif ($_GET['halaman']=="ubah_agama")
                {
                  include 'ubah_agama.php';
                }
                elseif ($_GET['halaman']=="status_nikah")
                {
                  include 'status_nikah.php';
                }
                elseif ($_GET['halaman']=="cari_status_nikah")
                {
                  include 'cari_status_nikah.php';
                }
                elseif ($_GET['halaman']=="tambah_status_nikah")
                {
                  include 'tambah_status_nikah.php';
                }
                elseif ($_GET['halaman']=="hapus_status_nikah")
                {
                  include 'hapus_status_nikah.php';
                }
                elseif ($_GET['halaman']=="ubah_status_nikah")
                {
                  include 'ubah_status_nikah.php';
                }
               elseif ($_GET['halaman']=="tunjangan")
                {
                  include 'tunjangan.php';
                }
                elseif ($_GET['halaman']=="cari_tunjangan")
                {
                  include 'cari_tunjangan.php';
                }
                elseif ($_GET['halaman']=="tambah_tunjangan")
                {
                  include 'tambah_tunjangan.php';
                }
                elseif ($_GET['halaman']=="hapus_tunjangan")
                {
                  include 'hapus_tunjangan.php';
                }
                elseif ($_GET['halaman']=="ubah_tunjangan")
                {
                  include 'ubah_tunjangan.php';
                }
                elseif ($_GET['halaman']=="potongan")
                {
                  include 'potongan.php';
                }
                elseif ($_GET['halaman']=="cari_potongan")
                {
                  include 'cari_potongan.php';
                }
                elseif ($_GET['halaman']=="tambah_potongan")
                {
                  include 'tambah_potongan.php';
                }
                elseif ($_GET['halaman']=="hapus_potongan")
                {
                  include 'hapus_potongan.php';
                }
                elseif ($_GET['halaman']=="ubah_potongan")
                {
                  include 'ubah_potongan.php';
                }
                elseif ($_GET['halaman']=="daftar_potongan")
                {
                  include 'daftar_potongan.php';
                }
                elseif ($_GET['halaman']=="cari_daftar_potongan")
                {
                  include 'cari_daftar_potongan.php';
                }
                elseif ($_GET['halaman']=="tambah_daftar_potongan")
                {
                  include 'tambah_daftar_potongan.php';
                }
                elseif ($_GET['halaman']=="hapus_daftar_potongan")
                {
                  include 'hapus_daftar_potongan.php';
                }
                elseif ($_GET['halaman']=="ubah_daftar_potongan")
                {
                  include 'ubah_daftar_potongan.php';
                }
                elseif ($_GET['halaman']=="daftar_tunjangan")
                {
                  include 'daftar_tunjangan.php';
                }
                elseif ($_GET['halaman']=="cari_daftar_tunjangan")
                {
                  include 'cari_daftar_tunjangan.php';
                }
                elseif ($_GET['halaman']=="tambah_daftar_tunjangan")
                {
                  include 'tambah_daftar_tunjangan.php';
                }
                elseif ($_GET['halaman']=="hapus_daftar_tunjangan")
                {
                  include 'hapus_daftar_tunjangan.php';
                }
                elseif ($_GET['halaman']=="ubah_daftar_tunjangan")
                {
                  include 'ubah_daftar_tunjangan.php';
                }
                elseif ($_GET['halaman']=="tambah_nota_tunjangan")
                {
                  include 'tambah_nota_tunjangan.php';
                }
                elseif ($_GET['halaman']=="transaksi_potongan")
                {
                  include 'transaksi_potongan.php';
                }
                elseif ($_GET['halaman']=="cari_transaksi_potongan")
                {
                  include 'cari_transaksi_potongan.php';
                }
                elseif ($_GET['halaman']=="tambah_transaksi_potongan")
                {
                  include 'tambah_transaksi_potongan.php';
                }
                elseif ($_GET['halaman']=="hapus_transaksi_potongan")
                {
                  include 'hapus_transaksi_potongan.php';
                }
                elseif ($_GET['halaman']=="ubah_transaksi_potongan")
                {
                  include 'ubah_transaksi_potongan.php';
                }
                elseif ($_GET['halaman']=="transaksi_tunjangan")
                {
                  include 'transaksi_tunjangan.php';
                }
                elseif ($_GET['halaman']=="cari_transaksi_tunjangan")
                {
                  include 'cari_transaksi_tunjangan.php';
                }
                elseif ($_GET['halaman']=="tambah_transaksi_tunjangan")
                {
                  include 'tambah_transaksi_tunjangan.php';
                }
                elseif ($_GET['halaman']=="hapus_transaksi_tunjangan")
                {
                  include 'hapus_transaksi_tunjangan.php';
                }
                elseif ($_GET['halaman']=="ubah_transaksi_tunjangan")
                {
                  include 'ubah_transaksi_tunjangan.php';
                }
                elseif ($_GET['halaman']=="slip_gaji")
                {
                  include 'slip_gaji.php';
                }
                elseif ($_GET['halaman']=="cari_slip_gaji")
                {
                  include 'cari_slip_gaji.php';
                }
                elseif ($_GET['halaman']=="tambah_slip_gaji")
                {
                  include 'tambah_slip_gaji.php';
                }
                elseif ($_GET['halaman']=="hapus_slip_gaji")
                {
                  include 'hapus_slip_gaji.php';
                }
                elseif ($_GET['halaman']=="ubah_slip_gaji")
                {
                  include 'ubah_slip_gaji.php';
                }  
                elseif ($_GET['halaman']=="buat_slip")
                {
                  include 'buat_slip.php';
                }  
                elseif ($_GET['halaman']=="detail_slip_gaji")
                {
                  include 'detail_slip_gaji.php';
                }  
                elseif ($_GET['halaman']=="laporan")
                {
                  include 'laporan.php';
                }  
                elseif ($_GET['halaman']=="slip_gaji")
                {
                  include 'slip_gaji.php';
                }
                elseif ($_GET['halaman']=="cari_slip_gaji")
                {
                  include 'cari_slip_gaji.php';
                }
                elseif ($_GET['halaman']=="tambah_slip_gaji")
                {
                  include 'tambah_slip_gaji.php';
                }
                elseif ($_GET['halaman']=="hapus_slip_gaji")
                {
                  include 'hapus_slip_gaji.php';
                }
                elseif ($_GET['halaman']=="ubah_slip_gaji")
                {
                  include 'ubah_slip_gaji.php';
                }  
                elseif ($_GET['halaman']=="detail_slip_gaji")
                {
                  include 'detail_slip_gaji.php';
                }
                elseif ($_GET['halaman']=="verifikasi_nota_potongan")
                {
                  include 'verifikasi_nota_potongan.php';
                }
                elseif ($_GET['halaman']=="laporan_gaji")
                {
                  include 'laporan_gaji.php';
                }
                 elseif ($_GET['halaman']=="laporan_potongan")
                {
                  include 'laporan_potongan.php';
                }
                 elseif ($_GET['halaman']=="laporan_tunjangan")
                {
                  include 'laporan_tunjangan.php';
                }
                 elseif ($_GET['halaman']=="laporan_agama")
                {
                  include 'laporan_agama.php';
                }
                 elseif ($_GET['halaman']=="laporan_divisi")
                {
                  include 'laporan_divisi.php';
                }
                 elseif ($_GET['halaman']=="laporan_status_nikah")
                {
                  include 'laporan_status_nikah.php';
                }
                 elseif ($_GET['halaman']=="detail_nota_tunjangan")
                {
                  include 'detail_nota_tunjangan.php';
                }
                  elseif ($_GET['halaman']=="laporan_golongan")
                {
                  include 'laporan_golongan.php';
                }
                  elseif ($_GET['halaman']=="laporan_jabatan")
                {
                  include 'laporan_jabatan.php';
                }
                 elseif ($_GET['halaman']=="laporan_karyawan")
                {
                  include 'laporan_karyawan.php';
                }
                 elseif ($_GET['halaman']=="nota_tunjangan")
                {
                  include 'nota_tunjangan.php';
                }
                 elseif ($_GET['halaman']=="nota_potongan")
                {
                  include 'nota_potongan.php';
                }
                 elseif ($_GET['halaman']=="detail_nota_potongan")
                {
                  include 'detail_nota_potongan.php';
                }
                 elseif ($_GET['halaman']=="detail_nota_tunjangan")
                {
                  include 'detail_nota_tunjangan.php';
                }
                elseif ($_GET['halaman']=="verifikasi_nota_potongan")
                {
                  include 'verifikasi_nota_potongan.php';
                }
                elseif ($_GET['halaman']=="laporan_gaji")
                {
                  include 'laporan_gaji.php';
                }
                 elseif ($_GET['halaman']=="laporan_potongan")
                {
                  include 'laporan_potongan.php';
                }
                 elseif ($_GET['halaman']=="laporan_tunjangan")
                {
                  include 'laporan_tunjangan.php';
                }
                 elseif ($_GET['halaman']=="laporan_agama")
                {
                  include 'laporan_agama.php';
                }
                 elseif ($_GET['halaman']=="laporan_divisi")
                {
                  include 'laporan_divisi.php';
                }
                 elseif ($_GET['halaman']=="laporan_status_nikah")
                {
                  include 'laporan_status_nikah.php';
                }
                 elseif ($_GET['halaman']=="detail_nota_tunjangan")
                {
                  include 'detail_nota_tunjangan.php';
                }
                  elseif ($_GET['halaman']=="laporan_golongan")
                {
                  include 'laporan_golongan.php';
                }
                  elseif ($_GET['halaman']=="laporan_jabatan")
                {
                  include 'laporan_jabatan.php';
                }
                 elseif ($_GET['halaman']=="laporan_karyawan")
                {
                  include 'laporan_karyawan.php';
                }
                elseif ($_GET['halaman']=="laporan_pengeluaran")
                {
                  include 'laporan_pengeluaran.php';
                }
                elseif ($_GET['halaman']=="laporan_karyawan")
                {
                  include 'laporan_karyawan.php';
                }
                elseif ($_GET['halaman']=="verifikasi_nota_tunjangan")
                {
                  include 'verifikasi_nota_tunjangan.php';
                }
                elseif ($_GET['halaman']=="verifikasi_nota_potongan")
                {
                  include 'verifikasi_nota_potongan.php';
                }
                elseif ($_GET['halaman']=="cari_nota_potongan")
                {
                  include 'cari_nota_potongan.php';
                }
                elseif ($_GET['halaman']=="hapus_nota_potongan")
                {
                  include 'hapus_nota_potongan.php';
                }
                elseif ($_GET['halaman']=="hapus_nota_potongan")
                {
                  include 'hapus_nota_potongan.php';
                }
                elseif ($_GET['halaman']=="cari_nota_tunjangan")
                {
                  include 'cari_nota_tunjangan.php';
                }
                elseif ($_GET['halaman']=="lihattunjangan")
                {
                  include 'lihattunjangan.php';
                }
                elseif ($_GET['halaman']=="lihatpotongan")
                {
                  include 'lihatpotongan.php';
                }
                elseif ($_GET['halaman']=="laporan_gaji_divisi")
                {
                  include 'laporan_gaji_divisi.php';
                }
                elseif ($_GET['halaman']=="laporan_gaji_golongan")
                {
                  include 'laporan_gaji_golongan.php';
                }
                elseif ($_GET['halaman']=="laporan_gaji_jabatan")
                {
                  include 'laporan_gaji_jabatan.php';
                }
                elseif ($_GET['halaman']=="laporan_transaksi")
                {
                  include 'laporan_transaksi.php';
                }
                elseif ($_GET['halaman']=="hapus_nota_tunjangan")
                {
                  include 'hapus_nota_tunjangan.php';
                }
                elseif ($_GET['halaman']=="transaksi_potongan")
                {
                  include 'transaksi_potongan.php';
                }
                elseif ($_GET['halaman']=="status_potongan")
                {
                  include 'status_potongan.php';
                }
                elseif ($_GET['halaman']=="cari_status_potongan")
                {
                  include 'cari_status_potongan.php';
                }
                elseif ($_GET['halaman']=="tambah_status_potongan")
                {
                  include 'tambah_status_potongan.php';
                }
                elseif ($_GET['halaman']=="hapus_status_potongan")
                {
                  include 'hapus_status_potongan.php';
                }
                elseif ($_GET['halaman']=="ubah_status_potongan")
                {
                  include 'ubah_status_potongan.php';
                }
                elseif ($_GET['halaman']=="laporan_verifikasi_potongan")
                {
                  include 'laporan_verifikasi_potongan.php';
                }
                elseif ($_GET['halaman']=="laporan_verifikasi_tunjangan")
                {
                  include 'laporan_verifikasi_tunjangan.php';
                }
                elseif ($_GET['halaman']=="laporan_status_potongan")
                {
                  include 'laporan_status_potongan.php';
                }
                elseif ($_GET['halaman']=="laporan_pengeluaran1")
                {
                  include 'laporan_pengeluaran1.php';
                }
              }
              else
              {
                include 'dashboard.php';
              }
              ?>
              <!--/ Layout Demo -->
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <?php include('footer.php');?>
            <!-- / Footer -->

            <div></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
  </nav>
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="assets/vendor/libs/jquery/jquery.js"></script>
    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
