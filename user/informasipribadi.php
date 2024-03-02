<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "zenithsalary";

$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Informasi Pribadi | ZenithSalary</title>
  <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<BODY STYLE="BACKGROUND-IMAGE:URL(bgriwayat.JPG)">


<?php include('header.php');?>


<section class="informasipribadi">
  <div class="container">
    <br>
    <br>
    <br>
    <h3> Informasi Pribadi  <?php echo $_SESSION["karyawan"]["nama_karyawan"]?> </h3>
    
    <table class="table table-bordered" style="background-color:#F4FBFF;">
      <tbody>
        <tr>
            <td colspan="2" style="text-align: center;">
                <div class="preloader flex-column justify-content-center align-items-center">
                    <img class="animation__shake" src="assets/img/info.gif" alt="" height="300" width="300">
                </div>
            </td>
            <td>
        <?php
          $nomor=1;
          //mendptkan id_pembeli pelanggan yg login
          $id_karyawan= $_SESSION["karyawan"]['id_karyawan'];
          
          $ambil=$koneksi->query("SELECT * FROM karyawan 
                        JOIN jabatan ON jabatan.id_jabatan = karyawan.id_jabatan
                        JOIN divisi ON divisi.id_divisi = karyawan.id_divisi
                        JOIN golongan ON golongan.id_golongan = karyawan.id_golongan
                        JOIN agama ON agama.id_agama = karyawan.id_agama
                        JOIN status_nikah ON status_nikah.id_status_nikah = karyawan.id_status_nikah
                        WHERE id_karyawan = '$id_karyawan';");
          while($pecah=$ambil->fetch_assoc()){    
        ?>
        <table class="table">
          <tbody>
              <tr>
                  <td style="width: 40%;">Nama Karyawan</td>
                  <td style="vertical-align: middle;"><?php echo $pecah['nama_karyawan']; ?></td>
              </tr>
              <tr>
                  <td>Agama</td>
                  <td style="vertical-align: middle;"><?php echo $pecah['nama_agama']; ?></td>
              </tr>
              <tr>
                            <td>Status Nikah  </td>
                            <td style="vertical-align: middle"> <?php echo $pecah['nama_status_nikah']; ?></td>
                          </tr>
                          <tr>
                            <td>Jumlah Anak   </td>
                            <td style="vertical-align: middle"> <?php echo $pecah['jumlah_anak']; ?></td>
                          </tr>
                          <tr>
                            <td>No Rekening   </td>
                            <td style="vertical-align: middle"> <?php echo $pecah['no_rekening']; ?></td>
                          </tr>
                          <tr>
                            <td>Divisi</td>
                            <td style="vertical-align: middle"> <?php echo $pecah['nama_divisi']; ?></td>
                          </tr>
                          <tr>
                            <td>Jabatan       </td>
                            <td style="vertical-align: middle"> <?php echo $pecah['nama_jabatan']; ?></td>
                          </tr>
                          <tr>
                            <td>Golongan      </td>
                            <td style="vertical-align: middle"> <?php echo $pecah['nama_golongan']; ?></td>
                          </tr>
                          <tr>
                            <td>Gaji Pokok      </td>
                            <td style="vertical-align: middle"> Rp <?php echo number_format( $pecah['gaji_pokok']); ?></td>
                          </tr>
              <!-- Tambahkan baris informasi lainnya sesuai kebutuhan -->
              
          </tbody>
      </table>
            </td>
        </tr>

          <?php $nomor++;?>
          <?php } ?>

      </tbody>
    </table>
    
  </div>
</section>



</body>
</html>