<?php
session_start ();
include 'config.php';
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
                <?php $subharga=0; ?>
                <?php $totalbelanja=0; ?>
                <?php foreach ($_SESSION["keranjang"] as $id_potongan=> $Jumlah): ?>
                        <!-- Menampilkan produk -->
            <?php
            $ambil = $koneksi->query("SELECT * FROM transaksi_potongan
            JOIN potongan ON transaksi_potongan.id_potongan = potongan.id_potongan
            WHERE transaksi_potongan.id_potongan = '$id_potongan'");
            $pecah = $ambil->fetch_assoc();
            ?>
                <tr>
                    <td><?php echo $nomor;?></td>
                    <td><?php echo $pecah["id_potongan"]; ?></td>
                    <td><?php echo $pecah["keterangan_potongan"]; ?></td>
                    <td><?php echo $pecah["tanggal_mulai"]; ?></td>
                    <td><?php echo $pecah["tanggal_selesai"]; ?></td>
                    <td><?php echo $pecah["lama_potongan"]; ?></td>
                    <td>Rp. <?php echo number_format($pecah["sub_total_potongan"]); ?></td>

                </tr>
                <?php $nomor++;?>
                <?php $totalbelanja+=$subharga; ?>
                <?php endforeach ?>
            </tbody>
            <tfoot>
                <tr> 
                    <th colspan='4' > Total Belanja </th>
                    <th> Rp. <?php echo number_format($sub_harga) ?>  </th>
                </tr>
            </tfoot>
            
        </table>
        <form method="post"> 
                <div class="col-md-4">
                <div class="form-group">
                    <label>  Tanggal Pengajuan  </label>
                    <input type="date" class="form-control" name="tanggal_pengajuan">
                </div>
                <br>
                <button class="btn btn-primary" name="ajukan">Ajukan</button>
            </div>

                <!-- /.<div>
                    <name="Kode_Statbayar" required>
                    //<?php 
                            //$ambil = $koneksi->query("SELECT * FROM status_pembayaran");
                            //$pecah = $ambil->fetch_assoc();
                        ?>
                        <div class="form-group"> 
                        <input type="text" readonly value="//<?php// echo $bayar["Kode_Statbayar"] ?>">
                        //<?php //echo $bayar['SB001'] ?>
                        
                        </div>
                        
                </div>
                
                <div>
                    <name="$Kode_Statboo" required>
                    //<?php 
                            //$ambill = $koneksi->query("SELECT * FROM status_booking");
                            //$pecahh = $ambill->fetch_assoc();
                        //?>
                </div> -->            
            </div>
            </br>        </form>
        
        <?php
        if (isset($_POST["ajukan"]))
        {
            $Kode_Konsumen = $_SESSION["karyawan"]["id_karyawan"];
            $dt1=$_POST['tanggal_pengajuan'];
            $Kode_Statboo="IDV002";

                $query = mysqli_query($koneksi, "SELECT max(id_nota_potongan) as kodeTerbesar FROM nota_potongan");
                $data = mysqli_fetch_array($query);
                $kodeFaktur = $data['kodeTerbesar'];
                $urutan = (int) substr($kodeFaktur, 3, 3);
                $urutan++;
                $huruf = "IDSG";
                $id_faktur = $huruf . sprintf("%03s", $urutan);
            //$a="FK00";
            //$b=$Kode_Konsumen;
            //$Kode_Faktur=$a.$b.rand(100,999);
            //menyimpan data ke tabel faktur

            $koneksi->query("INSERT INTO nota_potongan (id_nota_potongan, id_karyawan,tanggal_pengajuan, total_potongan,id_verifikasi)
                            VALUES ('$id_faktur', '$id_karyawan','$tanggal_pengajuan','$total')");
            
            //mendapatkan id Faktur barusan
            //$id_pembelian_barusan = $kode_auto_faktur;
            //$ambil=$koneksi->query("SELECT*FROM faktur");
            //$pecahh=$ambil->fetch_assoc();
            //$KodeFakturbaru=$pecahh['Kode_Faktur'];
            
            
            foreach ($_SESSION["keranjang"] as $id_potongan=>$Qty)
            {
                $ambils=$koneksi->query("SELECT * FROM potongan WHERE id_potongan='$id_potongan'");
                
                $perproduk=$ambils->fetch_assoc();
                $nama=$perproduk['nama_potongan'];
                $harga=$perproduk['max_potongan'];
                
                
                $koneksi->query("INSERT INTO transaksi_potongan (id_nota_potongan,id_potongan,keterangan_potongan, tanggal_mulai, tanggal_selesai,lama_potongan,besar_potongan)
                VALUES ('$id_faktur','$Id_Menu','$Qty','$totalbelanja')");
            }
            //mengosongkan keranjang belanjaan
            unset($_SESSION["keranjang"]);
            
            //tampilan dialihkan ke faktur, faktur pembelian barusan
            echo "<script>alert('Pembelian Sukses');</script>";
            echo "<script>location='faktur.php?id=$id_faktur';</script>";
        }   
        ?>
        
    
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
