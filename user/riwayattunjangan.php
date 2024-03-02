<section class="riwayat">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div style="color: black">
					<center><h2>Riwayat Belanja <?php echo $_SESSION["customer"]["Nama_Cust"]; ?></h2></center>
				</div>
			</div>
		</div>

		<table class="table">
			<thead>
				<tr>
					<th><center>No</th>
					<th><center>ID Daftar Tunjangan</th>
					<th><center>Total Pengajuan</th>
					<th><center>Status Verifikasi</th>
					<th><center>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$nomor = 1;
				// Mendapatkan id pelanggan yg login dari session
				$id_karyawan = $_SESSION["karyawan"]["id_karyawan"];
				$ambil = $koneksi->query("SELECT * FROM nota_tunjangan 
											JOIN karyawan ON nota_tunjangan.id_karyawan = karyawan.id_karyawan
											JOIN verifikasi ON nota_tunjangan.id_verifikasi = verifikasi.id_verifikasi
											WHERE id_karyawan='$id_karyawan'");
				while ($pecah = $ambil->fetch_assoc()) {
				?>
					<tr>
						<td><?php echo $nomor; ?></td>
						<td><?php echo $pecah["id_nota_tunjangan"]; ?></td>
						<td><?php echo $pecah["total_tunjangan"]; ?></td>
						<td><?php echo $pecah["status_verifikasi"]; ?></td>
						<td>
							<?php if ($pecah['nama_verifikasi'] == "Disetujui"): ?>
								<a href="fakturtunjangan.php?id_nota_tunjangan=<?php echo $pecah["id_nota_tunjangan"]; ?>" class="btn btn-info">Faktur</a>
							<?php endif; ?>
						</td>
					</tr>
					<?php $nomor++; ?>
				<?php } ?>
			</tbody>
		</table>
	</div>
</section>
</body>
</html>
