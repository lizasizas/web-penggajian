<h4><span class="text-muted fw-light"> Tunjangan |</span> Nota Tunjangan</h4>
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
    $strc[] = "nota_tunjangan.tanggal_pengajuan BETWEEN '$tgl_mulai' AND '$tgl_selesai'";
    $jmlh++;
}
if (isset($_POST['id_verifikasi'])) {
    $id_verifikasi = $_POST['id_verifikasi'];
    $strc[] = "nota_tunjangan.id_verifikasi='$id_verifikasi'";
    $jmlh++;
}
// Membuat kondisi pencarian
if ($jmlh > 0) {
  $strw = "WHERE ";
  $strw .= implode(" AND ", $strc);
}

$query = "SELECT * FROM transaksi_tunjangan 
          INNER JOIN nota_tunjangan ON nota_tunjangan.id_nota_tunjangan = transaksi_tunjangan.id_nota_tunjangan 
          INNER JOIN karyawan ON karyawan.id_karyawan = nota_tunjangan.id_karyawan
          INNER JOIN verifikasi ON nota_tunjangan.id_verifikasi = verifikasi.id_verifikasi
          $strw 
          ORDER BY nota_tunjangan.id_nota_tunjangan ASC";

$result = mysqli_query($koneksi, $query);
$resnum = mysqli_num_rows($result);

// Mendapatkan daftar jenis verifikasi
$pecah1 = $koneksi->query("SELECT * FROM verifikasi");
?>

<!-- Form pencarian -->
<div>
    <form action="index.php?halaman=nota_tunjangan" method="post" class="form">
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
                    <label>Status Verifikasi </label>
                    <select class="form-control" name="id_verifikasi">
                        <option selected disabled>PILIH JENIS VERIFIKASI</option>
                        <?php while ($row = mysqli_fetch_assoc($pecah1)) { ?>
                            <option value="<?php echo $row['id_verifikasi']; ?>"><?php echo $row['nama_verifikasi']; ?></option>
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
        <h5 class="card-header">Nota tunjangan</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Nota tunjangan</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Nama Karyawan</th>
                        <th>Total tunjangan</th>
                        <th>Lampiran </th>
                        <th>Verifikasi </th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php $no = 1; ?>
                    <?php while ($pecah = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                          <td><?php echo $pecah['id_nota_tunjangan']; ?></td>
                          <td><?php echo $pecah['tanggal_pengajuan']; ?></td>
                          <td><?php echo $pecah['nama_karyawan']; ?></td>
                          <td>Rp <?php echo number_format ($pecah['total_tunjangan']); ?></td>
                          <td><a href="index.php?halaman=lihattunjangan&id_nota_tunjangan=<?php echo $pecah['id_nota_tunjangan'];?>" class="btn btn-secondary">File</a></td>
                          <td><?php echo $pecah['nama_verifikasi']; ?></td>
                        
                          <td class='action'>

                           <?php if($pecah['nama_verifikasi']=="Ditolak"):?>
                            <a href="index.php?halaman=hapus_nota_tunjangan&id_nota_tunjangan=<?php echo $pecah['id_nota_tunjangan']?>" class="btn btn-danger">Hapus</a>
                            <a href="index.php?halaman=detail_nota_tunjangan&id_nota_tunjangan=<?php echo $pecah['id_nota_tunjangan']?>" class="btn btn-warning">Detail</a>
                              <?php endif?>


                           <?php if($pecah['nama_verifikasi']=="Disetujui"):?>
                            <a href="index.php?halaman=hapus_nota_tunjangan&id_nota_tunjangan=<?php echo $pecah['id_nota_tunjangan']?>" class="btn btn-danger">Hapus</a>
                            <a href="index.php?halaman=detail_nota_tunjangan&id_nota_tunjangan=<?php echo $pecah['id_nota_tunjangan']?>" class="btn btn-warning">Detail</a>
                              <?php endif?>

                          <?php if($pecah['nama_verifikasi']=="Sedang Diproses"):?>
                             <a href="index.php?halaman=hapus_nota_tunjangan&id_nota_tunjangan=<?php echo $pecah['id_nota_tunjangan']?>" class="btn btn-danger">Hapus</a>
                             <a href="index.php?halaman=detail_nota_tunjangan&id_nota_tunjangan=<?php echo $pecah['id_nota_tunjangan']?>" class="btn btn-warning">Detail</a>
                             <a href="index.php?halaman=verifikasi_nota_tunjangan&id_nota_tunjangan=<?php echo $pecah['id_nota_tunjangan']?>" class="btn btn-success">Verifikasi</a>
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
