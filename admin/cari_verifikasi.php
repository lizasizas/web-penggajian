<?php include('config/config.php');?>
<?php
if(isset($_POST['cari']))
{
	$_SESSION['session_pencarian']=$_POST["keyword"];
	$keyword=$_SESSION['session_pencarian'];
}
else
{
	$keyword=$_SESSION['session_pencarian'];
}
$query=mysqli_query($koneksi, "SELECT * FROM verifikasi 
                WHERE id_verifikasi LIKE '%$keyword%'
                OR nama_verifikasi LIKE '%$keyword%'")
?>

<h4><span class="text-muted fw-light"> Data Status |</span> Verifikasi</h4>
<div>
              <form class="form-horizontal" role="search" method="post" action="index.php?halaman=cari_verifikasi">
                <div class="row py-2 mb-2">
                  <div class="col-md-3">
                    <div class="form-group">
                      <input type="text" class="form-control" name="keyword" placeholder="Quick search..." autofocus autocomplete="off">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <button class="btn btn-primary" name="cari">Cari</button>
                  </div>
                  <div class="col-md-7 d-flex justify-content-end">
                    <a href="index.php?halaman=tambah_verifikasi" class="btn btn-info">Tambah Data</a>
                  </div>
                </div>
              </form>
</div>
              
              <!-- Hoverable Table rows -->
              <div class="card">
                <h5 class="card-header">Data verifikasi</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>ID Verifikasi</th>
                        <th>Nama Verifikasi</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php $no=1; ?>
                        <?php $ambil=$koneksi->query("SELECT * FROM verifikasi 
                            WHERE id_verifikasi LIKE '%$keyword%'
                            OR nama_verifikasi LIKE '%$keyword%'");?>
                        <?php while($pecah = $ambil->fetch_assoc()){?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $pecah['id_verifikasi']; ?></td>
                          <td><?php echo $pecah['nama_verifikasi']; ?></td>
                          <td class='action'>
                            <a href="index.php?halaman=ubah_verifikasi&id_verifikasi=<?php echo $pecah['id_verifikasi']?>" class="btn btn-primary">edit</a>
                            <a href="hapus_verifikasi.php?id_verifikasi=<?php echo $pecah['id_verifikasi']?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data?')" class="btn btn-danger" name="hapus" class="btn-danger btn">hapus</a>
                          </td>
                        </tr>
                        <?php $no++; ?>
                        <?php } ?>
                    </tbody>
                  </table>
                  
                </div>
              </div>