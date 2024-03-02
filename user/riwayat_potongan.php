<head>
	<title>Riwayat Pengajuan | ZenithSalary</title>
</head>
<?php
session_start();
$koneksi= new mysqli("localhost","root","","zenithsalary");
include("header.php");
$id_karyawan = $_SESSION['karyawan']['id_karyawan'];
$sqli = "SELECT * FROM nota_potongan WHERE id_karyawan = '$id_karyawan' ";
$queryi = $koneksi->query($sqli);

?>

<main>
<section class="riwayat">
	<div class="container">
		<div class="row">
			<div class="col-md-10">
				<div style="color: black">
				<br>
					<h2>Riwayat Pengajuan Potongan</h2>
				</div>
			</div>
		</div>

	<table class="table" style='background : pink' >
	<br>
			<thead>
				<tr>
					<th>No</th>
					<th>ID Pengajuan Potongan</th>
					<th>Tanggal Pengajuan</th>
					<th>Nama Karyawan</th>
					<th>Status Pengajuan</th>
					<th>Aksi</th>

				</tr>
			</thead>
			<tbody>
				<?php $nomor=1;?>
				<?php
					$ambil = $koneksi->query("SELECT * FROM nota_potongan 
					JOIN karyawan ON nota_potongan.id_karyawan = karyawan.id_karyawan
					JOIN verifikasi ON nota_potongan.id_verifikasi = verifikasi.id_verifikasi
					where nota_potongan.id_karyawan = '$id_karyawan';");
					while ($pecah = $ambil->fetch_assoc()) {
				?>
				<tr>
					<td><?php echo $nomor;?></td>
					<td><?php echo $pecah["id_nota_potongan"]; ?></td>
					<td><?php echo date("d F Y",strtotime($pecah["tanggal_pengajuan"])); ?></td>
					<td><?php echo $pecah["nama_karyawan"]; ?></td>
					<td><?php echo $pecah["nama_verifikasi"]; ?></td>
                    <td>
						<a href="lihatpotongan.php?id_nota_potongan=<?php echo $pecah['id_nota_potongan'];?>" class="btn btn-primary btn-success">File</a>
						<a href="fakturpotongan.php?id_nota_potongan=<?php echo $pecah["id_nota_potongan"]?>" class="btn btn-primary">Detail</a>
					</td>
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