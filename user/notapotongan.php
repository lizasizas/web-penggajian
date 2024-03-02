<?php
$koneksi = new mysqli("localhost", "root", "", "zenithsalary");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Potongan | ZenithSalary</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <style>
        body {
            background-image: url(nota.PNG);
        }
    </style>
</head>
<body>

<?php include 'header.php' ?>

<section class="notapotongan">
    <div class="container">
        <br>
        <br>
        <center><h3>Nota Potongan</h3></center>
        <br>

        <div class="container">
            <div class="row">
                <?php $totaljabatan = 0; ?>
                <?php $totaldivisi = 0; ?>
                <?php $totalgolongan = 0; ?>
                <?php $totaltransaksipotongan = 0; ?>
                <?php
                $id_nota_potongan = $_SESSION["karyawan"]['id_karyawan'];
                $ambil = $koneksi->query("SELECT * FROM karyawan
                     JOIN jabatan ON karyawan.id_jabatan=jabatan.id_jabatan
                     JOIN divisi ON karyawan.id_divisi=divisi.id_divisi
                     JOIN golongan ON karyawan.id_golongan=golongan.id_golongan
                     WHERE id_karyawan = '$id_nota_potongan'");
                while ($p = $ambil->fetch_assoc()) {
                    ?>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td style="width: 25%"><b>Nama Karyawan</b></td>
                                <td><?php echo $p['nama_karyawan']; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 25%"><b>Jabatan</b></td>
                                <td><?php echo $p['nama_jabatan']; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 25%"><b>Divisi</b></td>
                                <td><?php echo $p['nama_divisi']; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 25%"><b>Golongan</b></td>
                                <td><?php echo $p['nama_golongan']; ?></td>
                            </tr>
                        </tbody>
                    </table>

                <?php } ?>
                <table class="table">
                    <tr>
                        <td><b>JENIS POTONGAN</b></td>
                        <td><b>KETERANGAN</b></td>
                        <td><b>TANGGAL MULAI</b></td>
                        <td><b>TANGGAL SELESAI</b></td>
                        <td><b>STATUS VERIFIKASI</b></td>
                        <td><b>STATUS POTONGAN</b></td>
                        <td><b>LAMA PENGAJUAN</b></td>
                        <td><b>BESAR POTONGAN</b></td>
                        <td><b>CICILAN PER BULAN</b></td>
                    </tr>
                    <?php
                     $total_potongan =0;
                     $total_cicilan=0;
                    $ambi = $koneksi->query("SELECT sum(total_potongan) as potong FROM nota_potongan WHERE nota_potongan.id_karyawan='$id_nota_potongan'");
                    $potongan = $ambi->fetch_assoc();
                    $ambil11 = $koneksi->query("SELECT * FROM transaksi_potongan
                JOIN nota_potongan ON transaksi_potongan.id_nota_potongan=nota_potongan.id_nota_potongan
                JOIN potongan ON transaksi_potongan.id_potongan=potongan.id_potongan
                INNER JOIN verifikasi on nota_potongan.id_verifikasi=verifikasi.id_verifikasi
                JOIN status_potongan ON transaksi_potongan.id_status = status_potongan.id_status
                WHERE id_karyawan = '$id_nota_potongan' AND nota_potongan.id_verifikasi = 'IDV01';");
                    while ($pecah1 = $ambil11->fetch_assoc()) { ?>
                        </tr>
                        <tr>
                            <?php $total_potongan+=$pecah1['sub_total_potongan']; ?>
                            <?php $total_cicilan+=$pecah1['cicilan']; ?>
                            <td><?php echo $pecah1['nama_potongan']; ?> </td>
                             <td><?php echo $pecah1['keterangan_potongan']; ?> </td>
                            <td><?php echo $pecah1['tanggal_mulai']; ?> </td>
                            <td><?php echo $pecah1['tanggal_selesai']; ?> </td>
                            <td><?php echo $pecah1['nama_verifikasi']; ?></td>
                            <td><?php echo $pecah1['nama_status']; ?></td>
                            <td><?php echo $pecah1['lama_potongan']; ?> </td>
                            <td>Rp. <?php echo number_format($pecah1['sub_total_potongan']); ?></td>
                            <td>Rp. <?php echo number_format($pecah1['cicilan']); ?>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="7"><b>Total Potongan</b></td>
                        <td><b> Rp. <?php echo number_format($total_potongan); ?></b></td>
                        <td><b> Rp. <?php echo number_format($total_cicilan); ?></b></td>
                    </tr>
                </table>

                <td class='from-actions'>
                    <button onclick="window.print()" class="btn btn-success"><i class="fa fa-print"></i> Cetak</button>
                    <a href="ajukanpotongan.php" class="btn btn-primary">Tambah Potongan</a>
                </td>
            </div>
        </div>
</section>

</body>
</html>
