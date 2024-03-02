<?php
$koneksi = new mysqli("localhost", "root", "", "zenithsalary");
session_start();

    $query = "SELECT * FROM tunjangan";
    $ambil=mysqli_query($koneksi,$query);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Pengajuan Tunjangan | ZenithSalary</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>

<body style="background-image:url(nota.PNG)">

    <?php include 'header.php' ?>

    <section class="tambahnotatunjangan">
        <div class="container">
            <br>
            <center>
                <h2> Pengajuan tunjangan </h2>
            </center>
            <center>
                <h5> Silahkan pilih jenis tunjangan yang ingin diajukan! </h5>
            </center>
            </br>
        </div>
        <div class="container">
            <div class="row">
                <table class="table table-center">
                    <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th width="50%">Nama tunjangan</th>
                            <th width="40%">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-5">
                        <?php $no = 1; ?>     
                <?php while($row = mysqli_fetch_assoc($ambil)) { ?>
                          <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $row['nama_tunjangan']; ?></td>
                          <td class='action'>
                            <a href="tambahtunjangan.php?id_tunjangan=<?php echo $row['id_tunjangan']?>" class="btn btn-primary">Tambah</a>
                            <a href="detail_tunjangan.php?id_tunjangan=<?php echo $row['id_tunjangan']; ?>" class="btn-danger btn">INFO</a>
                        </td>
                        </tr>
                            <?php $no++; ?>
                        <?php } ?>
                    </tbody>
                </table>
        <td class='from-actions'>
            <a href="keranjangtunjangan.php" class="btn btn-primary">Lihat Pengajuan tunjangan</a>
        </td>
            </div>
        </div>
    </section>
</body>
</html>
