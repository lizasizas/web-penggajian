<?php
$koneksi=new mysqli("localhost","root","","zenithsalary");
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pengajuan Potongan | ZenithSalary</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<BODY STYLE="BACKGROUND-IMAGE:URL(nota.PNG)">

    <?php include'header.php'?>

    <section class="kontent">
        <form method="post" enctype="multipart/form-data">
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
                            <th> Lama potongan (bulan)</th>
                            <th> Besar Pengajuan Potongan </th>
                            <th> Actions </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $nomor=1; ?>
                        <?php foreach ($_SESSION["keranjangpotongan"] as $id_potongan=> $Jumlah): ?>
                            <!-- Menampilkan produk -->
                            <?php $ambil=$koneksi->query("SELECT * FROM potongan
                                WHERE id_potongan ='$id_potongan'"); 
                                $pecah=$ambil->fetch_assoc(); { ?>    
                                    <tr>
                                        <td><?php echo $nomor;?></td>
                                        <td><?php echo $pecah["nama_potongan"]; ?></td>
                                        <td>
                                            <input
                                            type="text"                                    
                                            class="form-control"
                                            name="keterangan_potongan[]"
                                            placeholder="isi keterangan potongan"
                                            aria-describedby="defaultFormControlHelp" />
                                        </td>
                                        <td>
                                            <input
                                            type="text"                                    
                                            class="form-control"
                                            name="lama_potongan[]"
                                            placeholder="isi lama potongan yang diajukan"
                                            aria-describedby="defaultFormControlHelp" />
                                        </td>
                                        <td>
                                            <input
                                            type="number"                                    
                                            class="form-control"
                                            name="sub_total_potongan[]"
                                            placeholder="isi besar potongan yang diajukan"
                                            aria-describedby="defaultFormControlHelp" />
                                        </td>
                                    <?php } ?>
                                    <td>
                                        <a href="hapus_keranjang.php?id_potongan=<?php echo $pecah['id_potongan'];?>" class="btn-danger btn">hapus</a>
                                    </td>
                                </tr>
                                <?php $nomor++; ?>
                            <?php endforeach ?> 
                        </tbody>
                    </table>
            <div class="form-group">
                <label for="bukti">Bukti Pengajuan</label>
                <input type="file" class="form-control" id="bukti" name="bukti" accept=".pdf" required>
                <small id="buktiHelp" class="form-text text-muted">Silakan unggah file dalam format .pdf.</small>
            </div>
                </hr>
            </br>
        </br>
        <button class="btn btn-primary" name="kirim">Ajukan</button>
    </form> 
</div>
</section>

<?php
if (isset($_POST["kirim"]))
{
    $namabukti = $_FILES["bukti"]["name"];
    $lokasibukti = $_FILES["bukti"]["tmp_name"];
    $namafiks = date("YmdHis") . $namabukti;
    move_uploaded_file($lokasibukti, "../bukti_verifikasi/$namafiks");
    $tanggal = date("Y-m-d");

    //buat nota potongan
    $query=mysqli_query($koneksi, "SELECT max(id_nota_potongan) as kodeTerbesar FROM nota_potongan");
    $data=mysqli_fetch_array($query);
    $id_nota_potongan=$data['kodeTerbesar'];
    $urutan=(int) substr($id_nota_potongan,3,3);
    $urutan++;
    $huruf="NP";
    $id_nota_potongan = $huruf . sprintf("%03s", $urutan);

    $id_verifikasi = "IDV02";
    $tanggal = date("Y-m-d");
    $id_karyawan = $_SESSION["karyawan"]['id_karyawan'];

    $koneksi->query("INSERT INTO nota_potongan(id_nota_potongan, id_karyawan, tanggal_pengajuan, id_verifikasi, lampiran_potongan) 
        VALUES ('$id_nota_potongan','$id_karyawan','$tanggal','$id_verifikasi', '$namafiks')");

    //buat transaksi
    $no=0;
    $total=0;
    foreach ($_SESSION['keranjangpotongan'] as $id_potongan => $value)
    {
        $ket = $_POST['keterangan_potongan'][$no];
        $lama = $_POST['lama_potongan'][$no];
        $sub = $_POST['sub_total_potongan'][$no];

        $pecah_tgl=explode("-",$tanggal);
        $thn=$pecah_tgl[0];
        $bln=$pecah_tgl[1];
        $tgl=$pecah_tgl[2];
        $intlama = (int)$lama;
        $intbulan = (int)$bln;
        $bln2 = $intbulan + $intlama;

        if($bln2 > 12)
        {
            $intthn = (int)$thn;
            $intthn = $intthn + 2;
            $bln2 =  $bln2 % 12;
            $tanggal_selesai = $intthn."-".$bln2."-".$tgl;
        }
        else
        {
            $tanggal_selesai = $thn."-".$bln2."-".$tgl;    
        }
        $timestamp = strtotime($tanggal_selesai);
        $date = date("Y-m-d", $timestamp);
        $id_status = "IDSP01";
        $total+=$sub;
        $cicilan=$sub/$lama;
        $koneksi->query("INSERT INTO transaksi_potongan(id_nota_potongan,id_potongan,keterangan_potongan,tanggal_mulai,tanggal_selesai,lama_potongan, sub_total_potongan,cicilan, id_status) 
        VALUES('$id_nota_potongan','$id_potongan','$ket','$tanggal','$date','$lama','$sub','$cicilan', '$id_status')");
        $no++;
    }
    $updatetotal = "UPDATE nota_potongan SET total_potongan = '$total' WHERE id_nota_potongan = '$id_nota_potongan'";
    mysqli_query($koneksi, $updatetotal);


    echo "<script> alert ('Pinjaman berhasil diajukan, tunggu proses selanjutnya!');</script>";
    echo "<script> location='fakturpotongan.php?id_nota_potongan=$id_nota_potongan';</script>";
}
/* tambah kolom cicilan di transaksi_potongan */
?>

</BODY>
</html>