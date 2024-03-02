<?php include('config.php');?>
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
$query=mysqli_query($koneksi, "SELECT * FROM nota_tunjangan 
JOIN karyawan ON nota_tunjangan.id_karyawan=karyawan.id_karyawan
JOIN verifikasi ON nota_tunjangan.id_verifikasi=verifikasi.id_verifikasi
WHERE id_nota_tunjangan LIKE '%$keyword%'
OR nama_karyawan LIKE '%$keyword%'
OR total_tunjangan LIKE '%$keyword%'
OR nama_verifikasi LIKE '%$keyword%';")
?>

<h4><span class="text-muted fw-light"> Nota tunjangan |</span> Nota tunjangan</h4>
<div>
              <form class="form-horizontal" role="search" method="post" action="index.php?halaman=cari_nota_tunjangan">
                <div class="row py-2 mb-2">
                  <div class="col-md-3">
                    <div class="form-group">
                      <input type="text" class="form-control" name="keyword" placeholder="Quick search..." autofocus autocomplete="off">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <button class="btn btn-primary" name="cari">Cari</button>
                  
                </div>
              </form>
</div>

              
              <!-- Hoverable Table rows -->
              <div class="card">
                <h5 class="card-header">Nota tunjangan</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>ID Nota tunjangan</th>
                        <th>Nama Karyawan</th>
                        <th>Total tunjangan</th>
                        <th>Lampiran </th>
                        <th> Verifikasi </th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php $no=1; ?>
                        <?php $ambil=$koneksi->query("SELECT * FROM nota_tunjangan 
                          JOIN karyawan ON nota_tunjangan.id_karyawan=karyawan.id_karyawan
                          JOIN verifikasi ON nota_tunjangan.id_verifikasi=verifikasi.id_verifikasi
                          WHERE id_nota_tunjangan LIKE '%$keyword%'
                          OR nama_karyawan LIKE '%$keyword%'
                          OR total_tunjangan LIKE '%$keyword%'
                          OR nama_verifikasi LIKE '%$keyword%';");?>
                        <?php while($pecah = $ambil->fetch_assoc()){?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $pecah['id_nota_tunjangan']; ?></td>
                          <td><?php echo $pecah['tanggal_pengajuan']; ?></td>
                          <td><?php echo $pecah['nama_karyawan']; ?></td>
                          <td><?php echo number_format ($pecah['total_tunjangan']); ?></td>
                          <td><a href="index.php?halaman=lihattunjangan&id_nota_tunjangan=<?php echo $pecah['id_nota_tunjangan'];?>" class="btn btn-primary btn-success">File</a></td>
                          <td><?php echo $pecah['nama_verifikasi']; ?></td>
                        
                          <td class='action'>

                           <?php if($pecah['nama_verifikasi']=="Ditolak"):?>
                            <a href="index.php?halaman=hapus_nota_tunjangan&id_nota_tunjangan=<?php echo $pecah['id_nota_tunjangan']?>" class="btn btn-danger">Hapus</a>
                            <a href="index.php?halaman=detail_nota_tunjangan&id_nota_tunjangan=<?php echo $pecah['id_nota_tunjangan']?>" class="btn btn-secondary">Detail</a>
                              <?php endif?>


                           <?php if($pecah['nama_verifikasi']=="Disetujui"):?>
                            <a href="index.php?halaman=hapus_nota_tunjangan&id_nota_tunjangan=<?php echo $pecah['id_nota_tunjangan']?>" class="btn btn-danger">Hapus</a>
                            <a href="index.php?halaman=detail_nota_tunjangan&id_nota_tunjangan=<?php echo $pecah['id_nota_tunjangan']?>" class="btn btn-warning">Detail</a>
                              <?php endif?>

                          <?php if($pecah['nama_verifikasi']=="Sedang Diproses"):?>
                             <a href="index.php?halaman=hapus_nota_tunjangan&id_nota_tunjangan=<?php echo $pecah['id_nota_tunjangan']?>" class="btn btn-danger">Hapus</a>
                            <a href="index.php?halaman=verifikasi_nota_tunjangan&id_nota_tunjangan=<?php echo $pecah['id_nota_tunjangan']?>" class="btn btn-success">Verifikasi</a>
                            <a href="index.php?halaman=detail_nota_tunjangan&id_nota_tunjangan=<?php echo $pecah['id_nota_tunjangan']?>" class="btn btn-warning">Detail</a>
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