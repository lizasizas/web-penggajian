<h4><span class="text-muted fw-light"> Potongan |</span> Transaksi Potongan</h4>
<?php
include 'config.php';

// Inisialisasi variabel
$strw = "";
$jmlh = 0;
$tgl_mulai = "";
$tgl_selesai = "";

// Memproses input form
if (isset($_POST['tgl_mulai'])) {
    $tgl_mulai = $_POST['tgl_mulai'];
    $tgl_selesai = isset($_POST['tgl_selesai']) ? $_POST['tgl_selesai'] : date("Y-m-d");
    $strc[] = "transaksi_potongan.tanggal_selesai BETWEEN '$tgl_mulai' AND '$tgl_selesai'";
    $jmlh++;
}
if (isset($_POST['id_status'])) {
    $id_status = $_POST['id_status'];
    $strc[] = "transaksi_potongan.id_status='$id_status'";
    $jmlh++;
}
// Membuat kondisi pencarian
if ($jmlh > 0) {
  $strw = "WHERE ";
  $strw .= implode(" AND ", $strc);
}

$query = "SELECT * FROM transaksi_potongan 
          INNER JOIN nota_potongan ON nota_potongan.id_nota_potongan = transaksi_potongan.id_nota_potongan 
          INNER JOIN karyawan ON karyawan.id_karyawan = nota_potongan.id_karyawan
          INNER JOIN status_potongan ON transaksi_potongan.id_status = status_potongan.id_status
          JOIN verifikasi ON nota_potongan.id_verifikasi = verifikasi.id_verifikasi
          $strw AND nota_potongan.id_verifikasi = 'IDV01'
          ORDER BY nota_potongan.id_nota_potongan ASC";

$result = mysqli_query($koneksi, $query);
$resnum = mysqli_num_rows($result);

// Mendapatkan daftar jenis verifikasi
$pecah1 = $koneksi->query("SELECT * FROM status_potongan");
?>

<!-- Form pencarian -->
<div>
    <form action="index.php?halaman=transaksi_potongan" method="post" class="form">
        <br/>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label>Dari Tanggal</label>
                    <input type="date" class="form-control" name="tgl_mulai" value="<?php echo $tgl_mulai?>" required >
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Sampai Tanggal</label>
                    <input type="date" class="form-control" name="tgl_selesai" value="<?php echo $tgl_selesai?>" required >
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Status Potongan </label>
                    <select class="form-control" name="id_status">
                        <option selected disabled>PILIH JENIS STATUS</option>
                        <?php while ($row = mysqli_fetch_assoc($pecah1)) { ?>
                            <option value="<?php echo $row['id_status']; ?>"><?php echo $row['nama_status']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="submit" class="btn btn-primary mb-4" name="submit" value="Search">
                </div>
            </div>
        </div>
    </form>

    <!-- Tampilkan hasil pencarian seperti sebelumnya -->
</div>

<!-- Tampilan tabel -->
<div>
    <div class="card">
        <h5 class="card-header">Transaksi potongan</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Nota potongan</th>
                        <th>Nama Karyawan</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Lama Potongan</th>
                        <th>Total </th>
                        <th>Cicilan </th>
                        <th>Status </th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php $no = 1; ?>
                    <?php while ($pecah = $result->fetch_assoc()) { ?>
                      <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $pecah['id_nota_potongan']; ?></td>
                          <td><?php echo $pecah['nama_karyawan']; ?></td>
                          <td><?php echo date("d F Y",strtotime($pecah["tanggal_mulai"])); ?></td>
                          <td><?php echo date("d F Y",strtotime($pecah["tanggal_selesai"])); ?></td>
                          <td><?php echo $pecah['lama_potongan']; ?> Bulan</td>
                          <td>Rp <?php echo number_format ($pecah['sub_total_potongan']); ?></td>
                          <td>Rp <?php echo number_format ($pecah['cicilan']); ?></td>
                        
                          <td>

                            <?php if($pecah['id_status']=="IDSP01"):?>
                                <button type="button" class="btn btn-secondary"><?php echo $pecah['nama_status']?></button>
                            <?php endif?>
                            <?php if($pecah['id_status']=="IDSP02"):?>
                                <button type="button" class="btn btn-success"><?php echo $pecah['nama_status']?></button>
                          </td>
                              <?php endif?>
                        </tr>
                        <?php $no++; ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
