<?php
session_start ();
include ('config.php');
//jika belum login
if(!isset($_SESSION["karyawan"]))
{
    echo "<script>alert('Silahkan login');</script>";
    echo "<script>location='../loginuser/';</script>";
}

if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{
        echo "<script>alert('Keranjang belum diisi, silahkan belanja dahulu ^-^');</script>";
        echo "<script>location='ajukanpotongan.php';</script>";
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

    <main>
     <section class="kontent">
        <div class="container">
        <br>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Potongan</th>
                    <th>Keteragan</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Lama Potongan</th>
                    <th>Besar Pengajuan Potongan</th>
                </tr>
            </thead>
            <tbody>
                
                <?php $nomor=1; ?>
                <?php foreach ($_SESSION["keranjang"] as $id_potongan=> $Jumlah): ?>
                        <!-- Menampilkan produk -->
            <?php
            $id_nota_potongan =  $_SESSION['nota_potongan']['id_nota_potongan'];
            $ambil = $koneksi->query("SELECT * FROM transaksi_potongan
            JOIN potongan ON transaksi_potongan.id_potongan = potongan.id_potongan
            WHERE transaksi_potongan.id_nota_potongan = '$id_nota_potongan'");
            $pecah = $ambil->fetch_assoc();
            ?>
                <tr>
                    <td><?php echo $nomor;?></td>
                    <td><?php echo $pecah["nama_potongan"]; ?></td>
                    <td><?php echo $pecah["keterangan_potongan"]; ?></td>
                    <td><?php echo $pecah["tanggal_mulai"]; ?></td>
                    <td><?php echo $pecah["tanggal_selesai"]; ?></td>
                    <td><?php echo $pecah["lama_potongan"]; ?></td>
                    <td>Rp. <?php echo number_format($pecah["sub_total_potongan"]); ?></td>

                </tr>
                <?php $nomor++;?>
                <?php endforeach ?>
            </tbody>
            <tfoot>
                <tr> 
                    <th colspan='4' > Total Belanja </th>
                    <th> Rp. <?php echo number_format($total_perbulan) ?>  </th>
                </tr>
            </tfoot>
            
        </table>
        <form method="post"> 
                <div class="col-md-4">
                <br>
                <button class="btn btn-primary" name="ajukan">Ajukan</button>
            </div>
        
    
</section>
</main>

<!--<pre><?php //print_r($_SESSION['konsumen'])?> </pre>
<pre><?php //print_r($_SESSION['keranjang'])?> </pre> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" type="text/javascript"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

    <script src="js/vendor/bootstrap.min.js"></script>

    <script src="js/datepicker.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
    <script src="js/jquery.js"></script>
    <script>
        $(document).ready(function() {
            $('#Id_JT_Pembayaran').change(function() {
                var Id_JT_Pembayaran = $(this).val();

                $.ajax({
                    type: 'POST',
                    url: 'ambilmetode.php',
                    data: 'Id_JT_Pembayaran='+Id_JT_Pembayaran,
                    success: function(response) {
                        $('#Id_Pembayaran').html (response);
                    }
                });
            })
        });
    </script>
</body>
</html>
