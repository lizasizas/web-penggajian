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

<div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-12"></div>
            <br><br><br><br>
            <h2>Nota Slip Gaji</h2><h4></h4>
            <?php $ambil = $koneksi->query("SELECT * FROM transaksi_tunjangan,tunjangan,daftar_tunjangan,karyawan WHERE 
                transaksi_tunjangan.id_daftar_tunjangan='$_GET[id]' AND
                transaksi_tunjangan.id_daftar_tunjangan=daftar_tunjangan.id_daftar_tunjangan AND
                transaksi_tunjangan.id_tunjangan=tunjangan.id_tunjangan AND
                daftar_tunjangan.id_karyawan=karyawan.id_karyawan
            ");
            $p = $ambil->fetch_assoc();?>
            <table class=" table">
                <tbody>
                <tr><td>ID Karyawan : <?php echo $pecah['id_karyawan'];?></td></tr>
                <tr><td>Nama Karyawan    : <?php echo $pecah['nama_karyawan'];?></td></tr>
                <tr><td>ID Daftar Tunjangan    : <?php echo $pecah['id_daftar_tunjangan'];?></td></tr>
            </table>
            <table class="table table-bordered">
                <thead>
                   <tr>
                            <th>Nama Tunjangan</th>
                            <th>Besar Tunjangan</th>
                            <th>Sub Total Tunjangan</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $no=1; $all=0;?>
                    <?php $ambil = $koneksi->query("SELECT * FROM transaksi_tunjangan,tunjangan,daftar_tunjangan,karyawan WHERE 
                transaksi_tunjangan.id_daftar_tunjangan='$_GET[id]' AND
                transaksi_tunjangan.id_daftar_tunjangan=daftar_tunjangan.id_daftar_tunjangan AND
                transaksi_tunjangan.id_tunjangan=tunjangan.id_tunjangan AND
                daftar_tunjangan.id_karyawan=karyawan.id_karyawan
                        ");
                     $a=$ambil->fetch_assoc()?>
                  <tr>
                    <td><?php echo $pecah["nama_tunjangan"]?></td>
                    <td><?php echo $pecah["besar_tunjangan"]?></td>
                    <td>Rp.<?php echo number_format($pecah['sub_total_tunjangan']);?></td>
                  </tr>
            </table>
                <tr><td>TOTAL TUNJANGAN    : Rp.<?php echo number_format($pecah['total_tunjangan']);?></td></tr>
                </tbody>
            </table>
    
    
    
    
    </div>
</section>


</body>
</html>