<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "zenithsalary";

$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
session_start();

?>
<!DOCTYPE html>
<html>
<head>
  <title> Informasi Pribadi </title>
  <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<BODY STYLE="BACKGROUND-IMAGE:URL(bgriwayat.JPG)">


<?php include'header.php'?>


<section class="bukti_verif">


<?php 
$ambil= $koneksi->query("UPDATE karyawan SET bukti_verifikasi='$namafiks'  WHERE id_karyawan='$id_karyawan'");
$detail=$ambil->fetch_assoc(); 
//echo "<pre>";
//print_r ($detail);
//echo "</pre>";

?>

<div class="row">
	<div class="col-md-6"></div>
		<table class="table table-bodered">
			<tr>
				<td>Bukti File Pembaruan Data</td>
			</tr>			
			<tr>
				<td><img src="../bukti_verif/<?php echo $detail['bukti_verifikasi'];?>" width="150" class="img-responsive"></td>
			</tr>
		</table>
</div>
</section>



</body>
</html>