<?php 

session_start();

$koneksi=new mysqli("localhost","root","","zenithsalary");


if(empty($_SESSION["keranjangtunjangan"]) OR !isset($_SESSION["keranjangtunjangan"]))
{
    echo"<script>alert('Pilihan kosong, silahkan pilih tunjangan');</script>";
    echo "<script>location='ajukantunjangan.php';</script>";
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Pengajuan Tunjangan | ZenithSalary</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<BODY STYLE="BACKGROUND-IMAGE:URL(nota.PNG)">

<?php include'header.php'?>
      
     <section class="kontent">
        <div class="container">
        <br>
        <br>
            <center><h3> Daftar Tunjangan Yang Diajukan </h3></center>
            <hr>
                <table class="table table bordered">
                    <thead>
                            <tr>
                                <th> No </th>
                                <th> Jenis Tunjangan </th>
                                <th> Besar Tunjangan </th>
                                <th> Keterangan </th>
                                <th> Sub Tunjangan </th>
                                <!-- <th> Kuantitas </th> -->
                                <th> Actions </th>
                            </tr>
                    </thead>
                    <tbody>
                        <?php $nomor=1; ?>
                        <?php foreach ($_SESSION["keranjangtunjangan"] as $id_tunjangan => $keterangan_tunjangan): ?>
                        <!-- Menampilkan produk -->
                        <?php
                        $ambil=$koneksi->query("SELECT * FROM tunjangan
                                WHERE id_tunjangan='$id_tunjangan'");
                        $pecah=$ambil->fetch_assoc(); 
                        $subharga=$pecah["besar_tunjangan"]*$keterangan_tunjangan;
                        ?>      
                        <tr>
                            <td><?php echo $nomor;?></td>
                            <td><?php echo $pecah["nama_tunjangan"]; ?></td>
                            <td>Rp. <?php echo number_format($pecah["besar_tunjangan"]); ?></td>
                            <td><?php echo $keterangan_tunjangan; ?></td>
                            <td>Rp. <?php echo number_format($subharga); ?></td>
                            <td>
                                <a href="hapus_tunjangan.php?id_tunjangan=<?php echo $id_tunjangan;?>" class="btn btn-warning">hapus</a>
                            </td>
                        </tr>
                        <?php $nomor++; ?>
                        <?php endforeach ?> 
                    </tbody>
                </table>
            </hr>
        </br>
        </br>
        
            <a href="ajukantunjangan.php"class="btn btn-default" name="tambah">Tambah Tunjangan</a>
            <a href="checkouttunjangan.php"class="btn btn-primary" name="ubah" >AJUKAN</a>
        </div>
        </form>

    </section>

<?php
if(isset ($_POST['ubah']))
{
    $koneksi->query("UPDATE transaksi_tunjangan SET nama_tunjangan='$_POST[nama_tunjangan]',besar_tunjangan='$_POST[besar_tunjangan]',keterangan_tunjangan='$_POST[keterangan_tunjangan]',
    sub_total_tunjangan='$_POST[subharga]' WHERE id_nota_tunjangan='$_GET[id_nota_tunjangan]';");
    
    echo "<script> alert('Data Berhasil Diubah');</script>";
    echo "<script>location='riwayattunjangan.php';</script>";
}
?>   


</body>
</html>