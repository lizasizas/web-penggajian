<?php
include("config.php");
session_start ();
    // mengambil data slip gaji dengan kode paling besar
$query1 = mysqli_query($koneksi, "SELECT MAX(id_nota_potongan) as kodeTerbesar FROM nota_potongan");
$data1 = mysqli_fetch_array($query1);
$id_nota_potongan = $data1['kodeTerbesar'];

    // mengambil angka dari kode slip gaji terbesar, menggunakan fungsi substr
    // dan diubah ke integer dengan (int)
$urutan = (int) substr($id_nota_potongan, 3, 3);

    // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$urutan++;

    // membentuk kode id_nota_potongan baru
    // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
    // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
    // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
$huruf = "IDNP";
$id_nota_potongan = $huruf . sprintf("%03s", $urutan);
?>

<!DOCTYPE html>
<html>
<head>
    <title> nota </title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<BODY STYLE="BACKGROUND-IMAGE:URL(nota.PNG)">

<?php include'header.php'?>

 <section class="kontent">
        <div class="container">
        <br>
        <br>
            <center><h3> Daftar Potongan Yang Diajukan </h3></center>
            <hr>
                <table class="table table bordered">
                    <thead>
                            <tr>
                                <th> No </th>
                                <th> Jenis Potongan</th>
                                <th> Keterangan Potongan </th>
                                <th> Tanggal Mulai </th>
                                <th> Tanggal Selesai </th>
                                <th> Lama potongan </th>
                                <th> Besar Pengajuan Potongan </th>
                                <!-- <th> Kuantitas </th> -->
                                <th> Actions </th>
                            </tr>
                    </thead>
                    <tbody>
                        <?php $nomor=1; ?>
				        <?php 
                        $total_perbulan = 0;
                        foreach ($_SESSION["keranjang"] as $id_potongan=> $Jumlah) {

                        
                        $ambil=$koneksi->query("SELECT * FROM potongan
                                WHERE id_potongan ='$id_potongan'");
                        $pecah=$ambil->fetch_assoc();
                       
                        ?>      
                        <tr>
                            <td><?php echo $nomor;?></td>
                            <td><?php echo $pecah["nama_potongan"]; ?></td>
                            <td>
                                <input
                                type="text"                                    
                                class="form-control"
                                name="keterangan_potongan[<?php echo $id_potongan; ?>]"
                                placeholder="isi keterangan potongan"
                                aria-describedby="defaultFormControlHelp" />
                            </td>
                            <td>
                            <div class="form-group">
                                <input type="date" class="form-control" name="tanggal_mulai">
                            </div>
                            </td>
                            <td>
                            <div class="form-group">
                                <input type="date" class="form-control" name="tanggal_selesai">
                            </div>
                            </td>
                            <td>
                                <input
                                type="text"                                    
                                class="form-control"
                                name="lama_potongan[<?php echo $id_potongan; ?>]"
                                placeholder="isi lama potongan yang diajukan"
                                
                                aria-describedby="defaultFormControlHelp" />
                            </td>
                            <td>
                                <input
                                type="text"                                    
                                class="form-control"
                                name="besar_potongan[<?php echo $id_potongan; ?>]"
                                placeholder="isi besar potongan yang diajukan"
                                
                                aria-describedby="defaultFormControlHelp" />
                            </td>
                            <td>
                                <a href="hapus_keranjang.php?id_potongan=<?php echo $pecah['id_potongan'];?>" class="btn-danger btn">hapus</a>
                            </td>
                            
                        </tr>
                        <?php } ?>
                        <?php
                         // Penghitungan total per bulan dan subtotal potongan
                            $keterangan_potongan = $_POST['keterangan_potongan'][$id_potongan] ?? '';
                            $lama_potongan = isset($_POST['lama_potongan'][$id_potongan]) ? intval($_POST['lama_potongan'][$id_potongan]) : 0;
                            $sub_potongan = isset($_POST['besar_potongan'][$id_potongan]) ? intval($_POST['besar_potongan'][$id_potongan]) : 0;

                            // Perhitungan subtotal per bulan
                            $sub_perbulan = ($lama_potongan !== 0) ? $sub_potongan / $lama_potongan : 0;
                            $total_perbulan += $sub_perbulan;
                        ?>
                    </tbody>
                </table>
            </hr>
        </br>
        </br>
        
        
            <a href="ajukan.php"class="btn btn-primary" name="kirim" >Ajukan</a>
        </div>
    </section>

    <?php
        if (isset($_POST["kirim"]))
        {

            $id_karyawan = $_SESSION["karyawan"]["id_karyawan"];
            $tanggal_pengajuan=date("Y-m-d");
            $tanggal_mulai = $_POST["tanggal_mulai"];
            $tanggal_selesai = $_POST["tanggal_selesai"];
            $ambill=$koneksi->query("SELECT * FROM verifikasi");

                $query = mysqli_query($koneksi, "SELECT max(id_nota_potongan) as kodeTerbesar FROM nota_potongan");
                $data = mysqli_fetch_array($query);
                $kodeFaktur = $data['kodeTerbesar'];
                $urutan = (int) substr($kodeFaktur, 3, 3);
                $urutan++;
                $huruf = "IDNP";
                $id_faktur = $huruf . sprintf("%03s", $urutan);

                $koneksi->query("INSERT INTO transaksi_potongan (id_nota_potongan, id_potongan, sub_total_potongan, keterangan_potongan, tanggal_mulai, tanggal_selesai, lama_potongan)
                VALUES ('$id_faktur', '$id_potongan', '$sub_potongan', '$keterangan_potongan', '$tanggal_mulai', '$tanggal_selesai', '$lama_potongan')");

                $koneksi->query("INSERT INTO nota_potongan (id_nota_potongan, id_karyawan, tanggal_pengajuan, total_potongan)
							VALUES ('$id_faktur', '$id_karyawan', '$tanggal_pengajuan','$total_perbulan')");
			
            //$a="FK00";
            //$b=$Kode_Konsumen;
            //$Kode_Faktur=$a.$b.rand(100,999);
            //menyimpan data ke tabel faktur
            //mendapatkan id Faktur barusan
            //$id_pembelian_barusan = $kode_auto_faktur;
            //$ambil=$koneksi->query("SELECT*FdROM faktur");
            //$pecahh=$ambil->fetch_assoc();
            //$KodeFakturbaru=$pecahh['Kode_Faktur'];
            
            
            foreach ($_SESSION["keranjang"] as $id_potongan=>$Qty)
            {
                $ambils=$koneksi->query("SELECT * FROM potongan WHERE id_potongan='$id_potongan'");
                $perproduk=$ambils->fetch_assoc();
                
                $koneksi->query("INSERT INTO transaksi_potongan (id_nota_potongan,id_potongan,sub_total_potongan, keterangan_potongan, tanggal_mulai, tanggal_selesai, lama_potongan)
                VALUES ('$id_faktur','$id_potongan','$sub_potongan','$totalbelanja', '$keterangan_potongan', '$tanggal_mulai', '$tanggal_selesai', '$lama_potongan')");
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
