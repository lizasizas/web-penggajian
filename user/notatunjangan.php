<?php $koneksi=new mysqli("localhost","root","","zenithsalary");
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Tunjangan | ZenithSalary</title>
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
                    $id_nota_tunjangan= $_SESSION["karyawan"]['id_karyawan'];
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
                                <td style="width: 25%"><b>Nama Karyawan</b></td>
                                <td><?php echo $p['nama_karyawan']; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 25%"><b>Jabatan</b></td>
                                <td><?php echo $p['nama_jabatan']; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 25%"><b>Divisi</b></td>
                                <td><?php echo $p['nama_divisi']; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 25%"><b>Golongan</b></td>
                                <td><?php echo $p['nama_golongan']; ?></td>
                            </tr>
                        </tbody>
                    </table>
            <?php } ?>
        <table class=" table">
        <tr>
            <td><b>tunjangan<b></td>
            <td><b>BESAR tunjangan</b></td>
        </tr>
            <?php
            $total_tunjangan =0;
             $ambi=$koneksi->query("SELECT sum(total_tunjangan) as tunjangan FROM nota_tunjangan WHERE nota_tunjangan.id_karyawan='$id_nota_tunjangan'");
                $tunjangan=$ambi->fetch_assoc();
             $ambil11=$koneksi->query("SELECT * FROM transaksi_tunjangan
                JOIN nota_tunjangan ON transaksi_tunjangan.id_nota_tunjangan=nota_tunjangan.id_nota_tunjangan
                JOIN tunjangan ON transaksi_tunjangan.id_tunjangan=tunjangan.id_tunjangan
                JOIN verifikasi ON verifikasi.id_verifikasi = nota_tunjangan.id_verifikasi
                WHERE id_karyawan = '$id_nota_tunjangan' AND nota_tunjangan.id_verifikasi = 'IDV01';"); 
            while ($pecah1=$ambil11->fetch_assoc()) { ?>
        </tr>
        <tr>
            <?php $total_tunjangan+=$pecah1['sub_total_tunjangan']; ?>
            <td><?php echo $pecah1['nama_tunjangan']; ?> </td>
            <td>Rp. <?php echo number_format ($pecah1['sub_total_tunjangan']); }
            ?> 
            </td>
        </tr>
        <tr>
            <td><b>Total tunjangan</b></td>
            <td><b> Rp. <?php echo number_format($total_tunjangan); ?></b></td>
        </tr>

    </table>

        <td class='from-actions'>
            <button  onclick="window.print()"  class="btn btn-success"><i class="fa fa-print"></i> Cetak</button>
            <a href="ajukantunjangan.php" class="btn btn-primary">Tambah tunjangan</a>
        </td>
               
    
    
    
    
    </div>
</section>


</body>
</html>