<?php
$koneksi = new mysqli("localhost", "root", "", "zenithsalary");
session_start();
$id_tunjangan = $_GET['id_tunjangan'];
$query = "SELECT * FROM tunjangan WHERE id_tunjangan = '$id_tunjangan'";
$ambil = mysqli_query($koneksi, $query);
$detail_tunjangan = mysqli_fetch_assoc($ambil);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Detail Tunjangan | ZenithSalary</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>

<body style="background-image:url(nota.PNG)">

    <?php include 'header.php'; ?>

    <section class="container py-1">
        <div class="row">
            <div  class="col-lg-10">
                <div class="text">
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <h1 class="h1"><strong>Detail Tunjangan</strong></h1>
                </div>
            </div>
        </div>
    </section>


    <section class="container py-1">
        <div class="row">
            
            <div class="col-md-6">
                <br><br>
                <h3></h3>
                <table class="table">
                    <tbody>
                        <tr>
                            <td><strong>Nama Tunjangan</strong></td>
                            <td><?php echo $detail_tunjangan["nama_tunjangan"]; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Besar Tunjangan</strong></td>
                            <td>Rp <?php echo number_format($detail_tunjangan["besar_tunjangan"]); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Syarat</strong></td>
                            <td>
                                <?php if ($id_tunjangan === 'IDT01') : ?>
                                    Hanya Dapat Mengajukan Satu Kali
                                <?php elseif ($id_tunjangan === 'IDT02') : ?>
                                    Hanya Dapat Mengajukan Dua Kali
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"> <!-- Menggunakan colspan agar tombol Kembali menempati dua kolom -->
                                <a class="btn btn-primary" href="ajukantunjangan.php" role="button">Kembali</a>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <br>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left" data-aos-delay="200">
                <img src="assets/img/illustration-6.svg" class="img-fluid animated" alt="">
            </div>

            
        </div>
        <br><br><br>
    </section>

</body>

</html>
