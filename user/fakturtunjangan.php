<?php
session_start ();
$db_host="localhost";
$db_user="root";
$db_pass="";
$db_name="zenithsalary";

$koneksi=mysqli_connect($db_host,$db_user,$db_pass,$db_name);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Pengajuan Tunjangan | ZenithSalary</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body style="background-image:url(nota.PNG)">

<?php include 'header.php' ?>

<section class="kontent">
		<div class="container">
		</br>
		</br>
			<center><h3> PENGAJUAN TUNJANGAN </h3></center>
</br>

<?php
$ambil=$koneksi->query("SELECT * FROM nota_tunjangan 
	JOIN karyawan on nota_tunjangan.id_karyawan=karyawan.id_karyawan
    JOIN golongan on karyawan.id_golongan=golongan.id_golongan 
    JOIN jabatan on karyawan.id_jabatan=jabatan.id_jabatan 
    JOIN divisi ON karyawan.id_divisi=divisi.id_divisi 
    WHERE nota_tunjangan.id_nota_tunjangan='$_GET[id_nota_tunjangan]' ");
$detail=$ambil->fetch_assoc();
?>
<!--- <pre><?php print_r($detail) ?></pre> --->
		
            <table class=" table">
                <tbody>
                    <tr>
                        <td style="width: 20%;"><strong>Nomor Nota</strong></td>
                        <td>:  <?php echo $detail['id_nota_tunjangan']; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 20%;"><strong>Tanggal</strong></td>
                        <td>:  <?php echo $detail['tanggal_pengajuan']; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 20%;"><strong>Nama Karyawan</strong></td>
                        <td>:  <?php echo $detail['nama_karyawan']; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 20%;"><strong>Jabatan</strong></td>
                        <td>:  <?php echo $detail['nama_jabatan']; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 20%;"><strong>Divisi</strong></td>
                        <td>: <?php echo $detail['nama_divisi']; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 20%;"><strong>Golongan</strong></td>
                        <td>: <?php echo $detail['nama_golongan']; ?></td>
                    </tr>
                </tbody>
            </table>
	
<table class="table table-bordered"> 
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Tunjangan</th>
			<th>Besar Tunjangan</th>
			<th>Keterangan</th>
			<th>Sub Total Tunjangan</th>
		</tr>
	</thead>
	<tbody>
	<?php $nomor=1;?>
	<?php $totaltunjangan=0;?>
		<?php $ambil=$koneksi->query("SELECT * FROM transaksi_tunjangan join tunjangan on transaksi_tunjangan.id_tunjangan=tunjangan.id_tunjangan WHERE transaksi_tunjangan.id_nota_tunjangan='$_GET[id_nota_tunjangan]' "); ?>
		<?php while($pecah=$ambil->fetch_assoc()){?>
		<tr>
			<td><?php echo $nomor ?></td>
			<td><?php echo $pecah['nama_tunjangan']; ?></td>
			<td><?php echo $pecah['besar_tunjangan']; ?></td>
			<td><?php echo $pecah['keterangan_tunjangan']; ?></td>
			<td><?php echo $pecah['besar_tunjangan']*$pecah['keterangan_tunjangan'];?></td>
			
		</tr>
		<?php $nomor++; ?>
		<?php $totaltunjangan+=($pecah['besar_tunjangan']*$pecah['keterangan_tunjangan']); ?>
		<?php } ?>
	</tbody>
	<tfoot>
		<tr>
			<th colspan="4"> <center>Total Tunjangan</center>  </th>
			<th>Rp. <?php echo number_format ($totaltunjangan) ?>
		</tr>
</table>



	</div>
</section>

	
</body>
</html>