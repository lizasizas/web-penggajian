<?php $koneksi=new mysqli("localhost","root","","zenithsalary");
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title> nota </title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<BODY STYLE="BACKGROUND-IMAGE:URL(nota.PNG)">



<?php include'header.php'?>

<section class="notatunjangan">
    <div class="container">
    </br>
    </br>
      <center><h3> Nota tunjangan </h3></center>
</br>

<div class="container">
        <div class="row">
            <?php $totaljabatan=0;?>
            <?php $totaldivisi=0;?>
            <?php $totalgolongan=0;?>
            <?php $totaltransaksitunjangan=0;?>
            <?php
                    $id_nota_tunjangan = $_SESSION["karyawan"]['id_karyawan'];
                    $ambil = $koneksi->query("SELECT * FROM karyawan
                     JOIN jabatan ON karyawan.id_jabatan=jabatan.id_jabatan
                     JOIN divisi ON karyawan.id_divisi=divisi.id_divisi
                     JOIN golongan ON karyawan.id_golongan=golongan.id_golongan
                     WHERE id_karyawan = '$id_nota_tunjangan'");
                     while($p=$ambil->fetch_assoc()){  
            ?>
            <table class="table">
                <tbody>
                    <tr>
                        <td style="width: 15%;"><strong>Nama Karyawan</strong></td>
                        <td>:  <?php echo $p['nama_karyawan']; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 15%;"><strong>Jabatan</strong></td>
                        <td>:  <?php echo $p['nama_jabatan']; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 15%;"><strong>Divisi</strong></td>
                        <td>: <?php echo $p['nama_divisi']; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 15%;"><strong>Golongan</strong></td>
                        <td>: <?php echo $p['nama_golongan']; ?></td>
                    </tr>
                </tbody>
            </table>

            <?php } ?>

            <table class='table'>
                <thead>
                    <tr>
                        <th>Nama Tunjangan</th>
                        <th>Keterangan</th>
                        <th>Besar Tunjangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $ambil = $koneksi->query("SELECT * FROM nota_tunjangan
                        JOIN transaksi_tunjangan ON transaksi_tunjangan.id_nota_tunjangan = nota_tunjangan.id_nota_tunjangan
                        JOIN tunjangan ON transaksi_tunjangan.id_tunjangan = tunjangan.id_tunjangan
                        WHERE id_karyawan = '$id_nota_tunjangan' AND nota_tunjangan.id_verifikasi='IDV01';");

                    while ($ambil1 = $ambil->fetch_assoc()) { ?>
                        <tr class='danger'>
                            <td><?php echo $ambil1['nama_tunjangan']?></td>
                            <td><?php echo $ambil1['keterangan_tunjangan']?></td>
                            <td>Rp <?php echo number_format($ambil1['sub_total_tunjangan']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>



        <div class='form-actions'>
          <button  onclick="window.print()"  class="btn btn-success"><i class="fa fa-print"></i> Cetak</button>
          <button onclick="window.location.href='ajukantunjangan.php'" type="button" class="btn btn-primary">Ajukan Tunjangan</button>
        </div>
               
    
    
    
    
    </div>
</section>


</body>
</html>