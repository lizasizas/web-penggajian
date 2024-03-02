
<?php 
$id_nota_tunjangan=$_GET['id_nota_tunjangan'];
$ambil=$koneksi->query("SELECT * FROM nota_tunjangan
				 JOIN karyawan ON nota_tunjangan.id_karyawan=karyawan.id_karyawan
				 JOIN verifikasi ON nota_tunjangan.id_verifikasi=verifikasi.id_verifikasi
				 WHERE id_nota_tunjangan='$id_nota_tunjangan'"); 
$detail=$ambil->fetch_assoc(); 
//echo "<pre>";
//print_r ($detail);
//echo "</pre>";

?>


<div class="row">
	<div class="col-md-6"></div>
		<table class="table table-bodered">
			<tr>
				<td>ID Nota Tunjangan </td>
				<td>Nama Karyawan  </td>
				<td>Jumlah Tunjangan </td>
				<td>Tanggal Pengajuan  </td>
				<td>Lampiran Pengajuan </td>
			</tr>			
			<tr>
				<td><?php echo $detail['id_nota_tunjangan'];?></td>
				<td><?php echo $detail['nama_karyawan'];?></td>
				<td>RP. <?php echo number_format($detail['total_tunjangan']);?></td>
				<td><?php echo $detail['tanggal_pengajuan'];?></td>
				<td>						<a href="lihattunjangan.php?id_nota_tunjangan=<?php echo $detail['id_nota_tunjangan'];?>" class="btn btn-primary btn-success">File</a></td>
			</tr>
		</table>
</div>
  <form method="post">
	<div class="form=group">
		<label>Status Verifikasi </label>
    <div class="controls">
		<select class="form-control" name="id_verifikasi" required>
        <option value=""> Pilih Status </option>
		<?php  $sql="SELECT * FROM verifikasi";
		$hasil=mysqli_query($koneksi, $sql);
        if (mysqli_num_rows($hasil) > 0) {
        while ($pecah = mysqli_fetch_array($hasil)){?>
          <option value="<?php echo $pecah['id_verifikasi'];?>">
          <?php echo $pecah['nama_verifikasi'];?></option>
          <?php } } ?>
      </select>
	</div>
	</br>
    <button class="btn btn-primary" name="proses">Proses</button>
  <a href="index.php?halaman=nota_tunjangan" class="btn btn-warning"> Kembali </a>
</form>
<?php

if(isset($_POST["proses"]))
{
	$id_verifikasi=$_POST["id_verifikasi"];
	$Kode_Statbo="BO001";
	$koneksi->query(" UPDATE nota_tunjangan SET id_verifikasi='$id_verifikasi' WHERE id_nota_tunjangan='$id_nota_tunjangan'");
	
	echo "<script>alert('Status Pembelian Diperbarui');</script>";
	echo "<script>location='index.php?halaman=nota_tunjangan';</script>";
}

?>
</body>
</html>