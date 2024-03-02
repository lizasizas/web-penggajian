<?php
include 'config.php';
$id_verifikasi = "";
$tanggal_mulai = "";
$strq = "";
$strw = "";
$jmlh = 0;


if (isset($_POST['id_verifikasi'])) {
    $id_verifikasi = $_POST['id_verifikasi'];
    $strc[] = "verifikasi.id_verifikasi LIKE '%$id_verifikasi%'";
    $jmlh++;
}

$i = 1;

if ($jmlh > 0) {
    $strw = "WHERE ";
    foreach ($strc as $strs) {
        $strw .= $strs;
        if ($i < $jmlh) {
            $strw .= " AND ";
            $i++;
        }
    }
}

$query = "SELECT *, COUNT(nota_potongan.id_verifikasi) AS total, SUM(nota_potongan.total_potongan) AS totalp
          FROM nota_potongan
          JOIN verifikasi ON nota_potongan.id_verifikasi = verifikasi.id_verifikasi
         $strw
          GROUP BY nota_potongan.id_verifikasi
          ORDER BY total DESC";
$result = mysqli_query($koneksi, $query);
$resnum = mysqli_num_rows($result);

$pecah2 = $koneksi->query("SELECT * FROM verifikasi");
?>
<h4><span class="text-muted fw-light"> LAPORAN |</span> PENGAJUAN POTONGAN</h4>

<form action="index.php?halaman=laporan_verifikasi_potongan" method="post" class="form">
    <br />
    <div class="row">
    
        <div class="col-md-3">
            <div class="form-group">
                <label>Jenis Verifikasi:</label>
                <select class="form-control" name="id_verifikasi" value = "<?php echo $row['id_verifikasi'] ?>">
                    <option selected disabled>-- PILIH JENIS VERIFIKASI -- </option>
                    <?php while ($row = mysqli_fetch_assoc($pecah2)) { ?>
                        <option value="<?php echo $row['id_verifikasi']; ?>"> <?php echo $row['nama_verifikasi']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <br />
            <input type="submit" class="btn btn-primary" name="submit" value="Search">
        </div>
    </div>
</form>
<br>
<div class="card">
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nomor</th>
            <th>Jenis Verifikasi</th>
            <th>Jumlah Pengajuan</th>
            <th>Total Nominal</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $nomor = 1;
        $total = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $nomor++; ?></td>
                <td><?php echo $row['nama_verifikasi']; ?></td>
                <td><?php echo $row['total']; ?></td>
                <td>Rp <?php echo number_format($row['totalp']); ?></td>
            </tr>
        <?php 
        $total += $row['totalp'];
        } ?>
        <tr>
            <td colspan="3"><center>Total </td>
            <td>Rp <?php echo number_format($total) ?></td>
        </tr>
    </tbody>
</table>
</div>
