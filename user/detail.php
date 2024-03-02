<?php session_start(); ?>
<?php include 'config.php';?>
<?php
	$id_potongan=$_GET["id_potongan"];
	
$ambil=$koneksi->query("SELECT * FROM potongan 
								WHERE id_potongan='$id_potongan'");
$detail=$ambil->fetch_assoc();
	
	//echo "<pre>";
	//print_r($detail);
	//echo "</pre>";

?>

<section class="konten">
	<div class="featured container no-gutter">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="attM6y">
					<span><h4><?php echo $detail["nama_potongan"] ?> </h4></span>
				</div>
				<div class="col-md-12">
					<h4> <strong> DESKRIPSI PENTING </strong> </h4> 
					<font size="5" face="Times New Roman"><h5>Deskripsi  :  <?php echo $detail["detail_keterangan"] ?></h5></font>
				</div>