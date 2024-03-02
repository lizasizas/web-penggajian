<?php
$koneksi = new mysqli("localhost", "root", "", "zenithsalary");
session_start();
$id_potongan = $_GET['id_potongan'];
$query = "SELECT * FROM potongan WHERE id_potongan = '$id_potongan'";
$ambil = mysqli_query($koneksi, $query);
$detail_potongan = mysqli_fetch_assoc($ambil);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Detail Potongan | ZenithSalary</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>

<body style="background-image:url(nota.PNG)">

    <?php include 'header.php'; ?>
<br>
<br>
<br>
<br>
    <section class="container py-1">
        <div class="row">
            <div  class="col-lg-10">
                <div class="text">
                    <h1 class="h1"><strong>Detail Potongan</strong></h1>
                </div>
            </div>
        </div>
    </section>


    <section class="container py-1">
        <div class="row">
            <div>
                <br><br>
                <h3></h3>
                <table class="table">
                    <tbody>
                    <tr>
                        <td>
                        <div class="preloader flex-column justify-content-center align-items-center">
                            <img class="animation__shake" src="assets/img/potongan.gif" alt="" height="300" width="300">
                        </div>
                        </td>
                        <td>
                        <table class="table">
                        <tbody>
                        <tr>
                            <td><strong>Nama Potongan</strong></td>
                            <td><?php echo $detail_potongan["nama_potongan"]; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Besar Maksimal Peminjaman</strong></td>
                            <td>Rp <?php echo number_format($detail_potongan["max_potongan"]); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Syarat</strong></td>
                            <td>Harus Mengajukan File Permohonan Peminjaman</td>
                        </tr>
                        <tr>
                            <td colspan="2"> <!-- Menggunakan colspan agar tombol Kembali menempati dua kolom -->
                                <a class="btn btn-primary" href="ajukanpotongan.php" role="button">Kembali</a>
                            </td>
                        </tr>
                        </tbody>
                        </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <br>
            </div>
        </div>
        <br><br><br>
    </section>

</body>

</html>
