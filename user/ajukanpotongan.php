<?php
$koneksi = new mysqli("localhost", "root", "", "zenithsalary");
session_start();

    $query = "SELECT * FROM potongan";
    $ambil=mysqli_query($koneksi,$query);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Pengajuan Potongan | ZenithSalary</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>

<body style="background-image:url(nota.PNG)">

    <?php include 'header.php' ?>

    <section class="tambahnotapotongan">
        <div class="container">
            <br>
            <center>
                <h2> Pengajuan Potongan </h2>
            </center>
            <center>
                <h5> Silahkan pilih jenis potongan yang ingin diajukan! </h5>
            </center>
            </br>
        </div>
        <div class="container">
            <div class="row">
                <table class="table table-center">
                    <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th width="50%">Nama Potongan</th>
                            <th width="40%">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-5">
                        <?php $no = 1; ?>     
                <?php while($row = mysqli_fetch_assoc($ambil)) { ?>
                          <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $row['nama_potongan']; ?></td>
                          <td class='action'>
                            <a href="tambahpotongan.php?id_potongan=<?php echo $row['id_potongan']?>" class="btn btn-primary">Tambah</a>
                            <a href="detail_potongan.php?id_potongan=<?php echo $row['id_potongan']; ?>" class="btn-danger btn">DETAIL</a>
                          </td>
                        </tr>
                            <?php $no++; ?>
                        <?php } ?>
                    </tbody>
                </table>
        <td class='from-actions'>
            <a href="keranjangpotongan.php" class="btn btn-primary">Lihat Pengajuan Potongan</a>
        </td>
            </div>
        </div>
    </section>
</body>
</html>
