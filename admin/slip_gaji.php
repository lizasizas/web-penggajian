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
    $strc[] = "slip_gaji.tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai'";
    $jmlh++;
}

if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];
    $strc[] = "karyawan.nama_karyawan LIKE '%$keyword%'";
    $jmlh++;
}

// Membuat kondisi pencarian
if ($jmlh > 0) {
    $strw = "WHERE ";
    $strw .= implode(" AND ", $strc);
}

// Membuat query berdasarkan kondisi pencarian
$query = "SELECT * FROM slip_gaji 
          JOIN karyawan ON slip_gaji.id_karyawan = karyawan.id_karyawan
          $strw";
$result = mysqli_query($koneksi, $query);
$resnum = mysqli_num_rows($result);
?>

<h4>SLIP GAJI</h4>
<div>
    <form action="index.php?halaman=slip_gaji" method="post" class="form">
        <br/>
        <div class="row">
            <div class="search-bar">
                <input type="text" name="keyword" placeholder="Cari Nama Karyawan" title="Masukkan keyword pencarian" autocomplete="off">
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label>Tanggal Mulai :</label>
                    <input type="date" class="form-control" name="tgl_mulai" value="<?php echo $tgl_mulai?>" required >
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Tanggal Selesai :</label>
                    <input type="date" class="form-control" name="tgl_selesai" value="<?php echo $tgl_selesai?>" required >
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="submit" class="btn btn-primary mb-4" name="submit" value="Search">
                </div>
            </div>
            <div class="col-md-2">
                <a href="index.php?halaman=tambah_slip_gaji" class="btn btn-info">Tambah Data</a>
            </div>
        </div>
    </form>

    <!-- Tampilkan hasil pencarian seperti sebelumnya -->
</div>

  
              <!-- Hoverable Table rows -->
              <div class="card">
                <h5 class="card-header">Slip Gaji</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>ID Slip Gaji</th>
                        <th>Nama Karyawan</th>
                        <th>Tanggal</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php $no=1; ?>
                        <?php while($pecah = $result->fetch_assoc()){?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $pecah['id_slip_gaji']; ?></td>
                          <td><?php echo $pecah['nama_karyawan']; ?></td>
                          <td><?php echo date("d F Y",strtotime($pecah["tanggal"])); ?></td>
                    <td class='action'>
                    <center><a href="index.php?halaman=detail_slip_gaji&id_slip_gaji=<?php echo $pecah["id_slip_gaji"]; ?>" class="btn btn-info">Slip Gaji</a>
                      
                          </td>
                        </tr>
                        <?php $no++; ?>
                        <?php } ?>
                    </tbody>
                  </table>
                  
                </div>
              </div>
</div>


