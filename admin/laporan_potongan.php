<?php
include 'config.php';
$id_potongan = "";
$tanggal_mulai = "";
$strq = "";
$strw = "";
$jmlh = 0;


if (isset($_POST['id_potongan'])) {
    $id_potongan = $_POST['id_potongan'];
    $strc[] = "potongan.id_potongan LIKE '%$id_potongan%'";
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

$query = "SELECT *, COUNT(transaksi_potongan.id_potongan) AS total, SUM(transaksi_potongan.sub_total_potongan) AS totalp
          FROM transaksi_potongan
          JOIN potongan ON transaksi_potongan.id_potongan = potongan.id_potongan
         $strw
          GROUP BY transaksi_potongan.id_potongan
          ORDER BY total DESC";
$result = mysqli_query($koneksi, $query);
$resnum = mysqli_num_rows($result);

$pecah2 = $koneksi->query("SELECT * FROM potongan");
?>
<h4><span class="text-muted fw-light"> LAPORAN |</span> POTONGAN</h4>
<div>
<form action="index.php?halaman=laporan_potongan" method="post" class="form">
    <div class="row">
    
        <div class="col-md-2">
            <div class="form-group">
                <label></label>
                <select class="form-control" name="id_potongan" value = "<?php echo $row['id_potongan'] ?>">
                    <option selected disabled>-- PILIH JENIS POTONGAN -- </option>
                    <?php while ($row = mysqli_fetch_assoc($pecah2)) { ?>
                        <option value="<?php echo $row['id_potongan']; ?>"> <?php echo $row['nama_potongan']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-3">
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
            <th>Nama potongan</th>
            <th>Jumlah Pengambilan</th>
            <th>Jumlah Potongan</th>
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
                <td><?php echo $row['nama_potongan']; ?></td>
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
</div>
