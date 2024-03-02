<?php include('config.php');?>
<html
  lang="en"
  class="light-style layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="assets//"
  data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Ubah Data | U-Wages Company</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets//img/logo.svg" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />
  <link rel="stylesheet" href="assets//vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets//vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets//vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets//css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets//vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="assets//vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets//js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

        
        </aside>
        <!-- / Menu -->
        <!-- / sidebar -->
          
      
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <meta name="description" content="" />
            <div class="container-xxl flex-grow-1 container-p-y">


           <?php           
                $id_karyawan=isset($_GET['id_karyawan']) ? $_GET['id_karyawan']:'';
                $sql="SELECT * FROM karyawan WHERE id_karyawan='$id_karyawan'";
                $hasil=mysqli_query($koneksi, $sql);
                while($data= mysqli_fetch_array($hasil)){
                echo
                "<div class='card'>
                    <form method='post' enctype='multipart/form-data'>
                        <h5 class='card-header'>Ubah Data</h5>
                            <div >
                                <label for='defaultFormControlInput' class='form-label'> Nama karyawan</label>
                                <input
                                type='text'                                    
                                class='form-control'
                                name='nama_karyawan'
                                placeholder='isi nama karyawan'
                                aria-describedby='defaultFormControlHelp' 
                                value='".$data['nama_karyawan']."'/>
                            </div>
                            <div>
                                <label for='defaultFormControlInput' class='form-label'> No Rekening</label>
                                <input
                                type='text'                                    
                                class='form-control'
                                name='no_rekening'
                                placeholder='isi no rekening'
                                aria-describedby='defaultFormControlHelp' 
                                value='".$data['no_rekening']."'/>
                            </div>
                            <div>
                                <label class='control-label'> Jabatan </label>
                                    <div class='controls'>
                                    <select class='form-control' name='id_jabatan' required>
                                        <option value=''>Pilih jabatan</option>";
                                            $sql2="SELECT * FROM jabatan";
                                            $hasil2=mysqli_query($koneksi, $sql2);
                                        if (mysqli_num_rows($hasil2) > 0) {
                                            while ($data2= mysqli_fetch_array($hasil2)){
                                            echo"
                                            <option value='".$data2['id_jabatan']."'>";
                                            echo $data2['nama_jabatan']; "</option>";
                                            } } 
                                            echo"
                                    </select>
                                    </div>
                            </div>
                            <div>
                                <label class='control-label'> Golongan </label>
                                    <div class='controls'>
                                    <select class='form-control' name='id_golongan' required>
                                        <option value=''>Pilih Golongan</option>";
                                            $sql2="SELECT * FROM golongan";
                                            $hasil2=mysqli_query($koneksi, $sql2);
                                        if (mysqli_num_rows($hasil2) > 0) {
                                            while ($data2= mysqli_fetch_array($hasil2)){
                                            echo"
                                            <option value='".$data2['id_golongan']."'>";
                                            echo $data2['nama_golongan']; "</option>";
                                            } } 
                                            echo"
                                    </select>
                                    </div>
                            </div>
                            <div>
                                <label class='control-label'> Divisi</label>
                                    <div class='controls'>
                                    <select class='form-control' name='id_divisi' required>
                                        <option value=''>Pilih divisi</option>";
                                            $sql2="SELECT * FROM divisi";
                                            $hasil2=mysqli_query($koneksi, $sql2);
                                        if (mysqli_num_rows($hasil2) > 0) {
                                            while ($data2= mysqli_fetch_array($hasil2)){
                                            echo"
                                            <option value='".$data2['id_divisi']."'>";
                                            echo $data2['nama_divisi']; "</option>";
                                            } } 
                                            echo"
                                    </select>
                                    </div>
                            </div>
                            <div>
                                <label class='control-label'> Agama</label>
                                    <div class='controls'>
                                    <select class='form-control' name='id_agama' required>
                                        <option value=''>Pilih agama</option>";
                                            $sql2="SELECT * FROM agama";
                                            $hasil2=mysqli_query($koneksi, $sql2);
                                        if (mysqli_num_rows($hasil2) > 0) {
                                            while ($data2= mysqli_fetch_array($hasil2)){
                                            echo"
                                            <option value='".$data2['id_agama']."'>";
                                            echo $data2['nama_agama']; "</option>";
                                            } } 
                                            echo"
                                    </select>
                                    </div>
                            </div>
                            <div>
                                <label class='control-label'> Status Nikah</label>
                                    <div class='controls'>
                                    <select class='form-control' name='id_status_nikah' required>
                                        <option value=''>Pilih Status Nikah</option>";
                                            $sql2="SELECT * FROM status_nikah";
                                            $hasil2=mysqli_query($koneksi, $sql2);
                                        if (mysqli_num_rows($hasil2) > 0) {
                                            while ($data2= mysqli_fetch_array($hasil2)){
                                            echo"
                                            <option value='".$data2['id_status_nikah']."'>";
                                            echo $data2['nama_status_nikah']; "</option>";
                                            } } 
                                            echo"
                                    </select>
                                    </div>
                            </div>
                            <div>
                                <label for='defaultFormControlInput' class='form-label'>J umlah Anak</label>
                                <input
                                type='text'                                    
                                class='form-control'
                                name='jumlah_anak'
                                placeholder='isi jumlah anak'
                                aria-describedby='defaultFormControlHelp' 
                                value='".$data['jumlah_anak']."'/>
                        </div>
                        <label for='defaultFormControlInput' class='form-label'>Foto Bukti</label>
                        <input type='file' name='bukti' class='form-control' required>
                        </div>
                        <div class='card-header'>
                            <button class='btn btn-primary' name='kirim'>Edit</button>
                            <a href='index.php?halaman=karyawan' class='btn btn-secondary'> Kembali </a>
                        </div>
                    </form>
                </div>";
                }
            ?>
              <?php
  if(isset($_POST['kirim']))
  {
    $sql=$koneksi->query("UPDATE karyawan SET nama_karyawan='$_POST[nama_karyawan]',no_rekening='$_POST[no_rekening]',id_jabatan='$_POST[id_jabatan]',id_golongan='$_POST[id_golongan]',id_divisi='$_POST[id_divisi]',id_agama='$_POST[id_agama]',id_status_nikah='$_POST[id_status_nikah]',jumlah_anak='$_POST[jumlah_anak]'  WHERE id_karyawan='$_GET[id_karyawan]'");
    if($sql) 
    {
      echo "<script>alert('Data Berhasil Diubah'); document.location.href='informasipribadi.php'; </script>";
    } 
    else 
    {
      echo "<script>alert('Proses Gagal'); document.location.href='ubahinformasipribadi.php'; </script>";
    }
  }
?>


<?php 
        if(isset($_POST["kirim"]))
        {
            $namabukti=$_FILES["bukti"]["name"];
            $lokasibukti=$_FILES["bukti"]["tmp_name"];
            $namafiks = date("YmdHis").$namabukti;
            move_uploaded_file($lokasibukti, "../bukti_verifikasi/$namafiks");
            $tanggal = date("Y-m-d");

            $koneksi->query("UPDATE karyawan SET bukti_verifikasi='$namafiks'  WHERE id_karyawan='$id_karyawan'");
            $koneksi->query("UPDATE karyawan SET id_verifikasi='IDV02' WHERE id_karyawan='$id_karyawan'");

            echo "<script>alert('silahkan tunggu untuk diverifikasi ');</script>";
            echo "<script>location='karyawan.php';</script>";
        }
    ?>
      
            
            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>
      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    
  </body>
</html>