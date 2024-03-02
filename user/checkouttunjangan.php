<?php
session_start();
include 'config.php';

if (empty($_SESSION["keranjangtunjangan"]) OR !isset($_SESSION["keranjangtunjangan"])) {
    echo "<script>alert('Keranjang belum diisi, silahkan belanja dahulu ^-^');</script>";
    echo "<script>location='ajukantunjangan.php';</script>";
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Pengajuan Tunjangan | ZenithSalary</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body style="background-image:url(nota.PNG)">

<?php include 'header.php' ?>

<main>
    <section class="kontent">
        <div class="container">
            <br>
            <br>
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-4">
                        <label>Nama Lengkap</label>
                        <div class="form-group">
                            <input type="text" readonly value="<?php echo $_SESSION["karyawan"]['nama_karyawan'] ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Tunjangan</th>
                            <th>Besar Tunjangan</th>
                            <th>Keterangan</th>
                            <th>Sub Tunjangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $nomor = 1; ?>
                        <?php $totaltunjangan = 0; ?>
                        <?php foreach ($_SESSION["keranjangtunjangan"] as $id_tunjangan => $keterangan_tunjangan): ?>
                            <?php
                            $ambil = $koneksi->query("SELECT * FROM tunjangan WHERE id_tunjangan='$id_tunjangan'");
                            $pecah = $ambil->fetch_assoc();
                            $subharga = $pecah["besar_tunjangan"] * $keterangan_tunjangan;
                            ?>
                            <tr>
                                <td><?php echo $nomor; ?></td>
                                <td><?php echo $pecah["nama_tunjangan"]; ?></td>
                                <td>Rp. <?php echo number_format($pecah["besar_tunjangan"]); ?></td>
                                <td><?php echo $keterangan_tunjangan; ?></td>
                                <td>Rp. <?php echo number_format($subharga); ?></td>
                            </tr>
                            <?php $nomor++; ?>
                            <?php $totaltunjangan += $subharga; ?>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan='4'> Total Tunjangan </th>
                            <th> Rp. <?php echo number_format($totaltunjangan) ?> </th>
                        </tr>
                    </tfoot>
                </table>
             <div class="form-group">
                <label for="bukti">Bukti Pengajuan</label>
                <input type="file" class="form-control" id="bukti" name="bukti" accept=".pdf" required>
                <small id="buktiHelp" class="form-text text-muted">Silakan unggah file dalam format .pdf.</small>
            </div>
                <button class="btn btn-primary" name="checkout">Simpan</button>
            </form>
        </div>
    </section>
</main>

<?php
if (isset($_POST["checkout"])) {

    $namabukti = $_FILES["bukti"]["name"];
    $lokasibukti = $_FILES["bukti"]["tmp_name"];
    $namafiks = date("YmdHis") . $namabukti;
    move_uploaded_file($lokasibukti, "../bukti_verifikasi/$namafiks");
    $tanggal = date("Y-m-d");

    // Generate Kode Nota
    $query = mysqli_query($koneksi, "SELECT max(id_nota_tunjangan) as kodeTerbesar FROM nota_tunjangan");
    $data = mysqli_fetch_array($query);
    $kodeFaktur = $data['kodeTerbesar'];
    $urutan = (int) substr($kodeFaktur, 3, 3);
    $urutan++;
    $huruf = "IDT";
    $id_nota_tunjangan = $huruf . sprintf("%03s", $urutan);

    // Insert Nota ke Database
    $karyawan = $_SESSION["karyawan"]["id_karyawan"];
    $verif = "IDV02";
    $insertNota = $koneksi->query("INSERT INTO nota_tunjangan (id_nota_tunjangan, id_karyawan, total_tunjangan, id_verifikasi, lampiran_tunjangan, tanggal_pengajuan)
                    VALUES ('$id_nota_tunjangan', '$karyawan', '$totaltunjangan', '$verif', '$namafiks', '$tanggal')");

    if ($insertNota) {
        foreach ($_SESSION["keranjangtunjangan"] as $id_tunjangan => $keterangan_tunjangan) {
            $ambil = $koneksi->query("SELECT * FROM tunjangan WHERE id_tunjangan='$id_tunjangan'");
            $perproduk = $ambil->fetch_assoc();
            $subharga = $perproduk["besar_tunjangan"] * $keterangan_tunjangan;

            // Insert Transaksi ke Database
            $insertTransaksi = $koneksi->query("INSERT INTO transaksi_tunjangan (id_nota_tunjangan, id_tunjangan, keterangan_tunjangan, sub_total_tunjangan) VALUES ('$id_nota_tunjangan', '$id_tunjangan', '$keterangan_tunjangan', '$subharga')");
        }

        // Clear Keranjang
        unset($_SESSION["keranjangtunjangan"]);

        echo "<script>alert('Pengajuan Sukses');</script>";
        echo "<script>location='fakturtunjangan.php?id_nota_tunjangan=$id_nota_tunjangan';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan nota.');</script>";
    }
}

?>

<!-- ... -->

</body>
</html>
