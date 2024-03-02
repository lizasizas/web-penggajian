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
$query=mysqli_query($koneksi, "SELECT * FROM karyawan 
                WHERE id_karyawan LIKE '%$keyword%'
                OR nama_karyawan LIKE '%$keyword%'
				")
?>

<h4><span class="text-muted fw-light"> Data Karyawan |</span> Karyawan</h4>
<div>
              <form class="form-horizontal" role="search" method="post" action="index.php?halaman=cari_karyawan">
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
                    <a href="index.php?halaman=tambah_karyawan" class="btn btn-info">Tambah Data</a>
                  </div>
                </div>
              </form>
</div>
              
              <!-- Hoverable Table rows -->
              <div class="card">
                <h5 class="card-header">Data Jenis karyawan</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>ID karyawan</th>
                        <th>Nama karyawan</th>
                        <th>No Rekening</th>
                        <th>Jabatan</th>
                        <th>Golongan</th>
                        <th>Divisi</th>
                        <th>Agama</th>
                        <th>Status Nikah</th>
                        <th>Jumlah Anak</th>
                        <th>Bukti Verifikasi</th>
                        <th>Status Verifikasi</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php $no=1; ?>
                        <?php $ambil=$koneksi->query("SELECT * FROM karyawan 
                        JOIN jabatan ON jabatan.id_jabatan = karyawan.id_jabatan
                        JOIN divisi ON divisi.id_divisi = karyawan.id_divisi
                        JOIN golongan ON golongan.id_golongan = karyawan.id_golongan
                        JOIN agama ON agama.id_agama = karyawan.id_agama
                        JOIN status_nikah ON status_nikah.id_status_nikah = karyawan.id_status_nikah
                        JOIN verifikasi ON verifikasi.id_verifikasi = karyawan.id_verifikasi
                        WHERE id_karyawan LIKE '%$keyword%'
                            OR nama_karyawan LIKE '%$keyword%'
                            OR nama_status_nikah LIKE '%$keyword%'
                            OR nama_jabatan LIKE '%$keyword%'
                            OR nama_golongan LIKE '%$keyword%'
                            OR nama_divisi LIKE '%$keyword%'
                            OR nama_agama LIKE '%$keyword%'
                            OR nama_verifikasi LIKE '%$keyword%';
                            ");?>
                        <?php while($pecah = $ambil->fetch_assoc()){?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $pecah['id_karyawan']; ?></td>
                          <td><?php echo $pecah['nama_karyawan']; ?></td>
                          <td><?php echo $pecah['no_rekening']; ?></td>
                          <td><?php echo $pecah['nama_jabatan']; ?></td>
                          <td><?php echo $pecah['nama_golongan']; ?></td>
                          <td><?php echo $pecah['nama_divisi']; ?></td>
                          <td><?php echo $pecah['nama_agama']; ?></td>
                          <td><?php echo $pecah['nama_status_nikah']; ?></td>
                          <td><?php echo $pecah['jumlah_anak']; ?></td>
                          <td><?php echo $pecah['bukti_verifikasi']; ?></td>
                          <td><?php echo $pecah['nama_verifikasi']; ?></td>
                          <td class='action'>
                            <a href="index.php?halaman=ubah_karyawan&id_karyawan=<?php echo $pecah['id_karyawan']?>" class="btn btn-primary">edit</a>
                            <a href="hapus_karyawan.php?id_karyawan=<?php echo $pecah['id_karyawan']?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data?')" class="btn btn-danger" name="hapus" class="btn-danger btn">hapus</a>
                          </td>
                        </tr>
                        <?php $no++; ?>
                        <?php } ?>
                    </tbody>
                  </table>
                  
                </div>
              </div>