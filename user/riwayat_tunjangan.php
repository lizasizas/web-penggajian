<head>
	<title>Riwayat Pengajuan | ZenithSalary</title>
</head>
<?php
session_start();
$koneksi= new mysqli("localhost","root","","zenithsalary");
include("header.php");
$id_karyawan = $_SESSION['karyawan']['id_karyawan'];
$sqli = "SELECT * FROM nota_tunjangan WHERE id_karyawan = '$id_karyawan' ";
$queryi = $koneksi->query($sqli);

?>
<main>
<section class="riwayat">
	<div class="container">
		<div class="row">
			<div class="col-md-10">
				<div style="color: black">
				<br>
					<h2>Riwayat Pengajuan Tunjangan</h2>
				</div>
			</div>
		</div>

	<table class="table" style='background : pink' >
	<br>
			<thead>
				<tr>
					<th>No</th>
					<th>ID Pengajuan Tunjangan</th>
					<th>Tanggal Pengajuan</th>
					<th>Nama Karyawan</th>
					<th>Status Pengajuan</th>
					<th>Aksi</th>

				</tr>
			</thead>
			<tbody>
				<?php $nomor=1;?>
				<?php
					$ambil = $koneksi->query("SELECT * FROM nota_tunjangan 
					JOIN karyawan ON nota_tunjangan.id_karyawan = karyawan.id_karyawan
					JOIN verifikasi ON nota_tunjangan.id_verifikasi = verifikasi.id_verifikasi
					where nota_tunjangan.id_karyawan = '$id_karyawan';");
					while ($pecah = $ambil->fetch_assoc()) {
				?>
				<tr>
					<td><?php echo $nomor;?></td>
					<td><?php echo $pecah["id_nota_tunjangan"]; ?></td>
					<td><?php echo date("d F Y",strtotime($pecah["tanggal_pengajuan"])); ?></td>
					<td><?php echo $pecah["nama_karyawan"]; ?></td>
					<td><?php echo $pecah["nama_verifikasi"]; ?></td>
                    <td>
                    	<a href="lihattunjangan.php?id_nota_tunjangan=<?php echo $pecah['id_nota_tunjangan'];?>" class="btn btn-primary btn-success">File</a>
                    	<a href="detail_nota_tunjangan.php?id_nota_tunjangan=<?php echo $pecah["id_nota_tunjangan"]?>" class="btn btn-primary">Detail</a></td>
				</tr>
				<?php $nomor++; ?>
				<?php } ?>
			</tbody>
		</table>
	</div>
</section>
</main>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" type="text/javascript"></script>
	<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

		<script src="js/vendor/bootstrap.min.js"></script>

		<script src="js/datepicker.js"></script>
		<script src="js/plugins.js"></script>
		<script src="js/main.js"></script>
	</body>
	</html>