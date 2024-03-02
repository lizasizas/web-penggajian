<?php
include 'config.php';
$id_tunjangan = "";
$tanggal_mulai = "";
$strq = "";
$strw = "";
$jmlh = 0;


if (isset($_POST['id_tunjangan'])) {
    $id_tunjangan = $_POST['id_tunjangan'];
    $strc[] = "tunjangan.id_tunjangan='$id_tunjangan'";
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

$query = "SELECT *, COUNT(transaksi_tunjangan.id_tunjangan) AS total, SUM(transaksi_tunjangan.sub_total_tunjangan) AS totalj
          FROM transaksi_tunjangan 
          JOIN tunjangan ON transaksi_tunjangan.id_tunjangan = tunjangan.id_tunjangan
         $strw
          GROUP BY transaksi_tunjangan.id_tunjangan
          ORDER BY total DESC";
$result = mysqli_query($koneksi, $query);
$resnum = mysqli_num_rows($result);

$pecah2 = $koneksi->query("SELECT * FROM tunjangan");


?>
<h4><span class="text-muted fw-light"> LAPORAN |</span> TUNJANGAN</h4>
<div>
<form action="index.php?halaman=laporan_tunjangan" method="post" class="form">
    <div class="row">
    
        <div class="col-md-2">
            <div class="form-group">
                <label></label>
                <select class="form-control" name="id_tunjangan" value = "<?php echo $row['id_tunjangan'] ?>">
                    <option selected disabled>-- PILIH JENIS TUNJANGAN -- </option>
                    <?php while ($row = mysqli_fetch_assoc($pecah2)) { ?>
                        <option value="<?php echo $row['id_tunjangan']; ?>"> <?php echo $row['nama_tunjangan']; ?></option>
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
            <th>Nama Tunjangan</th>
            <th>Jumlah Pengambilan</th>
            <th>Jumlah Tunjangan</th>
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
                <td><?php echo $row['nama_tunjangan']; ?></td>
                <td><?php echo $row['total']; ?></td>
                <td>Rp <?php echo number_format($row['totalj']); ?></td>
            </tr>
        <?php 
        $total += $row['totalj'];
        } ?>
        <tr>
            <td colspan="3"><center>Total </td>
            <td>Rp <?php echo number_format($total) ?></td>
        </tr>
    </tbody>
</table>
</div>
</div>

