<?php
session_start();
include("config.php");

if(!isset($_SESSION["karyawan"]))
{
	echo "<script>alert('Anda Harus Login Terlebih Dahulu');</script>";
	echo "<script>location='../loginuser/';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Checkout </title>
	<link rel="stylesheet" href="app/assets/css/bootstrap.css">
</head>

<?php include ('header.php');?>
<section class="konten">
	
	<div class="container">
	<h3> Daftar Tunjangan Yang Diajukan </h3>
    <form method="post">
		<table class= "table table-bordered" >
			<thead>
				<tr>
					<th>No.</th>
					<th>Nama Tunjangan</th>
					<th>Keterangan</th>
					<th>Besar Tunjangan</th>
				</tr>
			</thead>
			<tbody>
				<?php $nomor=1;?>
				<?php $total_perbulan=0;?>
				<?php $jumlah1=0;?>
				<?php foreach ($_SESSION['keranjang_tunjangan'] as $id_tunjangan=> $jumlah):?>
				<?php
					$ambil=$koneksi->query("SELECT * FROM tunjangan WHERE id_tunjangan='$id_tunjangan'");
					$pecah=$ambil->fetch_assoc();
					$sub_besar_tunjangan=$pecah["besar_tunjangan"]*$jumlah;
				?>
				<tr>
					<td><?php echo $nomor;?></td>
					<td><?php echo $pecah["nama_tunjangan"];?> </td>
                    <td>
                        <input type="hidden" name="id_tunjangan" value="<?php echo $id_tunjangan; ?>">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="keterangan" placeholder="isi keterangan" value="">
                                </div>
                            </div>
                    </td>
					<td>Rp <?php echo number_format($sub_besar_tunjangan);?> </td>
				</tr>
				<?php $nomor++;?>
				<?php $total_perbulan+=$sub_besar_tunjangan;?>
				<?php $jumlah1+=$jumlah;?>
				<?php endforeach ?>
			</tbody>
			<tfoot>
				<tr>
					<th colspan="3"> Total Tambahan Tunjangan per Bulan</th>
					<th>Rp <?php echo number_format( $total_perbulan)?>
				</tr>
			</tfoot>
		</table>
        <button class="btn btn-primary" name="checkout">Ajukan</button>
	</form>
			
		<?php $ambil=$koneksi->query("SELECT * FROM nota_tunjangan  
		JOIN verifikasi ON nota_tunjangan.id_verifikasi = verifikasi.id_verifikasi; ");?>
			
		<?php
		if(isset($_POST["checkout"]))
		{
			$id_karyawan=$_SESSION["karyawan"]["id_karyawan"];
			$tanggal_pengajuan=date("Y-m-d");
			
			$query=mysqli_query($koneksi, "SELECT max(id_nota_tunjangan) as kodeTerbesar FROM nota_tunjangan");
			$data=mysqli_fetch_array($query);
			$id_nota_tunjangan=$data['kodeTerbesar'];
			$urutan=(int) substr($id_nota_tunjangan,3,3);
			$urutan++;
			$huruf="IDT";
			$id_nota_tunjangan = $huruf . sprintf("%03s", $urutan);
			
			$koneksi->query(
            "INSERT INTO nota_tunjangan (id_nota_tunjangan, tanggal_pengajuan, total_tunjangan, id_karyawan) 
			VALUES ('$id_nota_tunjangan','$tanggal_pengajuan', '$total_perbulan', '$id_karyawan')");
			$ambil=$koneksi->query("SELECT * FROM nota_tunjangan");
			$pecahh=$ambil->fetch_assoc();
			$id_nota_tunjangan=$pecahh['id_nota_tunjangan'];
            $keterangan = $_POST['keterangan'];
			
			foreach ($_SESSION["keranjang_tunjangan"] as $id_tunjangan => $qty) {
				$ambil_tunjangan = $koneksi->query("SELECT * FROM tunjangan WHERE id_tunjangan='$id_tunjangan'");
				$pecah_tunjangan = $ambil_tunjangan->fetch_assoc();
		
				$sub_qty = $qty; 
				$sub_besar_tunjangan = $pecah_tunjangan["besar_tunjangan"] * $sub_qty; 
		
				$koneksi->query("INSERT INTO transaksi_tunjangan (id_nota_tunjangan, id_tunjangan, sub_total_tunjangan, keterangan_tunjangan) 
					VALUES ('$id_nota_tunjangan', '$id_tunjangan', '$sub_besar_tunjangan', '$keterangan')");
			}
				unset($_SESSION['keranjang_tunjangan']);
			
			echo "<script>alert('Pengajuan Sukses');</script>";
			echo "<script>location='bukti_pengajuan.php?id_nota_tunjangan=$id_nota_tunjangan';</script>";
		}
		?>
		
	</div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" type="text/javascript"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

	<script src="js/vendor/bootstrap.min.js"></script>

	<script src="js/datepicker.js"></script>
	<script src="js/plugins.js"></script>
	<script src="js/main.js"></script>
	<script src="js/jquery.js"></script>
</body>
</html>