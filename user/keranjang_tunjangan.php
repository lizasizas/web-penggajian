<?php
$koneksi=new mysqli("localhost","root","","zenithsalary");
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

    <section class="kontent">
        <form method="post" enctype="multipart/form-data">
            <div class="container">
                <br>
                <br>
                <center><h3> Daftar Tunjangan Yang Diajukan </h3></center>
                <hr>
                <table class="table table bordered">
                    <thead>
                        <tr>
                            <th> No </th>
                            <th> Jenis Tunjangan</th>
                            <th> Keterangan Tunjangan </th>
                            <th> Actions </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $nomor=1; ?>
                        <?php foreach ($_SESSION["keranjangtunjangan"] as $id_tunjangan=> $Jumlah): ?>
                            <!-- Menampilkan produk -->
                            <?php $ambil=$koneksi->query("SELECT * FROM tunjangan
                                WHERE id_tunjangan ='$id_tunjangan'"); 
                                $pecah=$ambil->fetch_assoc(); { ?>    
                                    <tr>
                                        <td><?php echo $nomor;?></td>
                                        <td><?php echo $pecah["nama_tunjangan"]; ?></td>
                                        <td>
                                            <input
                                            type="text"                                    
                                            class="form-control"
                                            name="keterangan_tunjangan[]"
                                            placeholder="isi keterangan tunjangan"
                                            aria-describedby="defaultFormControlHelp" />
                                        </td>
                                    <?php } ?>
                                    <td>
                                        <a href="hapus_keranjang_tunjangan.php?id_tunjangan=<?php echo $pecah['id_tunjangan'];?>" class="btn-danger btn">hapus</a>
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

    //buat nota tunjangan
    $query=mysqli_query($koneksi, "SELECT max(id_nota_tunjangan) as kodeTerbesar FROM nota_tunjangan");
    $data=mysqli_fetch_array($query);
    $id_nota_tunjangan=$data['kodeTerbesar'];
    $urutan=(int) substr($id_nota_tunjangan,3,3);
    $urutan++;
    $huruf="IDT";
    $id_nota_tunjangan = $huruf . sprintf("%03s", $urutan);

    $id_verifikasi = "IDV02";
    $tanggal = date("Y-m-d");
    $id_karyawan = $_SESSION["karyawan"]['id_karyawan'];

    $koneksi->query("INSERT INTO nota_tunjangan(id_nota_tunjangan, id_karyawan, tanggal_pengajuan, id_verifikasi, lampiran_tunjangan) 
        VALUES ('$id_nota_tunjangan','$id_karyawan','$tanggal','$id_verifikasi', '$namafiks')");

    //buat transaksi
    $no=0;
    $total=0;
    foreach ($_SESSION['keranjangtunjangan'] as $id_tunjangan => $value)
    {
        $ket = $_POST['keterangan_tunjangan'][$no];

        $timestamp = strtotime($tanggal_selesai);
        $date = date("Y-m-d", $timestamp);
        
        $koneksi->query("INSERT INTO transaksi_tunjangan(id_nota_tunjangan,id_tunjangan,keterangan_tunjangan,sub_total_tunjangan) 
        VALUES('$id_nota_tunjangan','$id_tunjangan','$ket','$sub')");
        $no++;
    }
    $updatetotal = "UPDATE nota_tunjangan SET total_tunjangan = '$total' WHERE id_nota_tunjangan = '$id_nota_tunjangan'";
    mysqli_query($koneksi, $updatetotal);


    echo "<script> alert ('Data berhasil ajukan, silahkan lengkapi langkah selanjtnya');</script>";
    echo "<script> location='fakturtunjangan.php?id_nota_tunjangan=$id_nota_tunjangan';</script>";
}
/* tambah kolom cicilan di transaksi_tunjangan */
?>

</BODY>
</html>