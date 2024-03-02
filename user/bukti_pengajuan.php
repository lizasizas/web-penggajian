<?php
session_start();
include("config.php");

$idnota= $_GET["id_nota_tunjangan"];
$ambil=$koneksi->query("SELECT *FROM nota_tunjangan WHERE id_nota_tunjangan='$idnota'");
$detpem=$ambil->fetch_assoc();

include ('header.php');
?>
<main>
		<form method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label> Bukti Pengajuan Tunjangan </label>
				<input  type="file" class="form-control" name="bukti" required>
				<p class="text-danger"> File pengajuan Maks.2MB </p>
			</div>
			<button class="btn btn-purple" name="kirim">Kirim</button>
			<a href="riwayat_tunjangan.php" class="btn btn-purple">Kembali </a>
		</form>
	</div>

	<?php
	if(isset($_POST["kirim"]))
	{
		$namabukti=$_FILES["bukti"]["name"];
		$lokasibukti=$_FILES["bukti"]["tmp_name"];
		$namafiks=date("Y-m-d").$namabukti;
		move_uploaded_file($lokasibukti,"../pengajuan/$namafiks");

		$tanggal=date("Y-m-d");
		$kode="IDV02";

		$koneksi->query("UPDATE nota_tunjangan SET lampiran_potongan='$namafiks', id_verifikasi='$kode' WHERE id_nota_tunjangan='$idnota'");			

		echo "<script>alert('Silahkan Tunggu Admin Memproses Pengajuan');</script>";
		echo "<script>location='riwayat_tunjangan.php';</script>";
	}
	?>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" type="text/javascript"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

	<script src="js/vendor/bootstrap.min.js"></script>

	<script src="js/datepicker.js"></script>
	<script src="js/plugins.js"></script>
	<script src="js/main.js"></script>
</body>
</html>