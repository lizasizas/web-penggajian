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
$query=mysqli_query($koneksi, "SELECT * FROM tunjangan 
                WHERE id_tunjangan LIKE '%$keyword%'
                OR nama_tunjangan LIKE '%$keyword%'
				OR besar_tunjangan LIKE '%$keyword%'")
?>

<h4><span class="text-muted fw-light"> Data tunjangan |</span> Jenis Tunjangan</h4>
<div>
              <form class="form-horizontal" role="search" method="post" action="index.php?halaman=cari_tunjangan">
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
                    <a href="index.php?halaman=tambah_tunjangan" class="btn btn-info">Tambah Data</a>
                  </div>
                </div>
              </form>
</div>

    <!-- Hoverable Table rows -->
    <div class="card">
                <h5 class="card-header">Data Jenis Tunjangan</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>ID Tunjangan</th>
                        <th>Nama Tunjangan</th>
                        <th>Besar Tunjangan</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php $no=1; ?>
                        <?php $ambil=$koneksi->query("SELECT * FROM tunjangan
                                WHERE id_tunjangan LIKE '%$keyword%' 
                                OR nama_tunjangan LIKE '%$keyword%'
                                OR besar_tunjangan LIKE '%$keyword%'");?>
                        <?php while($pecah = $ambil->fetch_assoc()){?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $pecah['id_tunjangan']; ?></td>
                          <td><?php echo $pecah['nama_tunjangan']; ?></td>
                          <td>Rp <?php echo number_format ($pecah['besar_tunjangan']); ?></td>
                          <td class='action'>
                            <a href="index.php?halaman=ubah_tunjangan&id_tunjangan=<?php echo $pecah['id_tunjangan']?>" class="btn btn-primary">edit</a>
                            <a href="hapus_tunjangan.php?id_tunjangan=<?php echo $pecah['id_tunjangan']?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data?')" class="btn btn-danger" name="hapus" class="btn-danger btn">hapus</a>
                          </td>
                        </tr>
                        <?php $no++; ?>
                        <?php } ?>
                    </tbody>
                  </table>
                  
                </div>
    </div>