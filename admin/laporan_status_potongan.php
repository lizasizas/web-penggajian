<?php
include 'config.php';
$id_status = "";
$tanggal_mulai = "";
$strq = "";
$strw = "";
$jmlh = 0;


if (isset($_POST['id_status'])) {
    $id_status = $_POST['id_status'];
    $strc[] = "status_potongan.id_status='$id_status'";
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

$query = "SELECT *, COUNT(transaksi_potongan.id_status) AS total, SUM(transaksi_potongan.sub_total_potongan) AS totalj
          FROM transaksi_potongan 
          JOIN status_potongan ON transaksi_potongan.id_status = status_potongan.id_status
         $strw
          GROUP BY transaksi_potongan.id_status
          ORDER BY total DESC";
$result = mysqli_query($koneksi, $query);
$resnum = mysqli_num_rows($result);

$pecah2 = $koneksi->query("SELECT * FROM status_potongan");


?>
<h4><span class="text-muted fw-light"> LAPORAN |</span> STATUS POTONGAN</h4>
<div>
<form action="index.php?halaman=laporan_status_potongan" method="post" class="form">
    <div class="row">
    
        <div class="col-md-3">
            <div class="form-group">
                <select class="form-control" name="id_status" value = "<?php echo $row['id_status'] ?>">
                    <option selected disabled>-- PILIH JENIS STATUS -- </option>
                    <?php while ($row = mysqli_fetch_assoc($pecah2)) { ?>
                        <option value="<?php echo $row['id_status']; ?>"> <?php echo $row['nama_status']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-2">
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
            <th>Jenis Status</th>
            <th>Jumlah Transaksi</th>
            <th>Jumlah potongan</th>
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
                <td><?php echo $row['nama_status']; ?></td>
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
