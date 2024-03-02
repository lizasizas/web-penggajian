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
$query=mysqli_query($koneksi, "SELECT * FROM nota_potongan 
                JOIN karyawan on nota_potongan.id_karyawan=karyawan.id_karyawan
                JOIN verifikasi on nota_potongan.id_verifikasi=verifikasi.id_verifikasi
                WHERE id_nota_potongan LIKE '%$keyword%'
                OR karyawan.nama_karyawan LIKE '%$keyword%'
                OR total_potongan LIKE '%$keyword%'
                OR lampiran_potongan LIKE '%$keyword%'
                OR verifikasi.id_verifikasi LIKE '%$keyword%'")
?>

<h4><span class="text-muted fw-light"> Data Karyawan |</span> Status Nikah</h4>
<div>
              <form class="form-horizontal" role="search" method="post" action="index.php?halaman=cari_nota_potongan">
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
                    <a href="index.php?halaman=tambah_nota_potongan" class="btn btn-info">Tambah Data</a>
                  </div>
                </div>
              </form>
</div>
              
              <!-- Hoverable Table rows -->
              <div class="card">
                <h5 class="card-header">Data Nota Potongan</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>ID Nota Potongan</th>
                        <th>Nama Karyawan</th>
                        <th>Total Potongan</th>
                        <th>Lampiran </th>
                        <th> Verifikasi </th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php $no=1; ?>
                       <?php $ambil=$koneksi->query("SELECT * FROM  nota_potongan 
                JOIN karyawan on nota_potongan.id_karyawan=karyawan.id_karyawan
                JOIN verifikasi on nota_potongan.id_verifikasi=verifikasi.id_verifikasi
                WHERE id_nota_potongan LIKE '%$keyword%'
                OR karyawan.nama_karyawan LIKE '%$keyword%'
                OR total_potongan LIKE '%$keyword%'
                OR lampiran_potongan LIKE '%$keyword%'
                OR verifikasi.id_verifikasi LIKE '%$keyword%'");?>
                        <?php while($pecah = $ambil->fetch_assoc()){?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $pecah['id_nota_potongan']; ?></td>
                          <td><?php echo $pecah['nama_karyawan']; ?></td>
                          <td><?php echo number_format ($pecah['total_potongan']); ?></td>
                          <td><a href="index.php?halaman=lihatpotongan&id_nota_potongan=<?php echo $pecah['id_nota_potongan'];?>" class="btn btn-primary btn-success">File</a></td>
                          <td><?php echo $pecah['nama_verifikasi']; ?></td>
                        
                          <td class='action'>

                           <?php if($pecah['nama_verifikasi']=="Ditolak"):?>
                            <a href="index.php?halaman=hapus_nota_potongan&id_nota_potongan=<?php echo $pecah['id_nota_potongan']?>" class="btn btn-danger">Hapus</a>
                            <a href="index.php?halaman=detail_nota_potongan&id_nota_potongan=<?php echo $pecah['id_nota_potongan']?>" class="btn btn-warning">Detail</a>
                              <?php endif?>


                           <?php if($pecah['nama_verifikasi']=="Disetujui"):?>
                            <a href="index.php?halaman=hapus_nota_potongan&id_nota_potongan=<?php echo $pecah['id_nota_potongan']?>" class="btn btn-danger">Hapus</a>
                            <a href="index.php?halaman=detail_nota_potongan&id_nota_potongan=<?php echo $pecah['id_nota_potongan']?>" class="btn btn-warning">Detail</a>
                              <?php endif?>

                          <?php if($pecah['nama_verifikasi']=="Sedang Diproses"):?>
                             <a href="index.php?halaman=hapus_nota_potongan&id_nota_potongan=<?php echo $pecah['id_nota_potongan']?>" class="btn btn-danger">Hapus</a>
                            <a href="index.php?halaman=verifikasi_nota_potongan&id_nota_potongan=<?php echo $pecah['id_nota_potongan']?>" class="btn btn-success">Verifikasi</a>
                            <a href="index.php?halaman=detail_nota_potongan&id_nota_potongan=<?php echo $pecah['id_nota_potongan']?>" class="btn btn-warning">Detail</a>
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