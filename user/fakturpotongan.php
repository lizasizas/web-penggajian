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
	<title>Pengajuan Potongan | ZenithSalary</title>
</head>
<body style="background-image:url(nota.PNG)">

<?php include 'header.php' ?>

<section class="kontent">
		<div class="container">
		</br>
		</br>
			<center><h3> PENGAJUAN POTONGAN </h3></center>
</br>

<?php
$ambil=$koneksi->query("SELECT * FROM nota_potongan 
	JOIN karyawan on nota_potongan.id_karyawan=karyawan.id_karyawan
    JOIN golongan on karyawan.id_golongan=golongan.id_golongan 
    JOIN jabatan on karyawan.id_jabatan=jabatan.id_jabatan 
    JOIN divisi ON karyawan.id_divisi=divisi.id_divisi 
    WHERE nota_potongan.id_nota_potongan='$_GET[id_nota_potongan]' ");
$detail=$ambil->fetch_assoc();
?>
<!--- <pre><?php print_r($detail) ?></pre> --->
		
            <table class=" table">
                <tbody>
                    <tr>
                        <td style="width: 30%;"><strong>Nota Pengajuan Potongan</strong></td>
                        <td>:  <?php echo $detail['id_nota_potongan']; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 30%;"><strong>Tanggal Pengajuan Potongan</strong></td>
                        <td>:  <?php echo $detail['tanggal_pengajuan']; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 30%;"><strong>Nama Karyawan</strong></td>
                        <td>:  <?php echo $detail['nama_karyawan']; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 30%;"><strong>Jabatan</strong></td>
                        <td>:  <?php echo $detail['nama_jabatan']; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 30%;"><strong>Divisi</strong></td>
                        <td>: <?php echo $detail['nama_divisi']; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 30%;"><strong>Golongan</strong></td>
                        <td>: <?php echo $detail['nama_golongan']; ?></td>
                    </tr>
                </tbody>
            </table>
	
<table class="table table-bordered"> 
	<thead>
		<tr>
			<th>No</th>
			<th>Nama potongan</th>
			<th>Keterangan</th>
			<th>Tanggal Mulai</th>
			<th>Tanggal Selesai</th>
			<th>Lama Potongan</th>
			<th>Besar Potongan</th>
			<th>Cicilan</th>
		</tr>
	</thead>
	<tbody>
	<?php $nomor=1;?>
	<?php $totalpotongan=0;?>
		<?php $ambil=$koneksi->query("SELECT * FROM transaksi_potongan 
        JOIN potongan ON transaksi_potongan.id_potongan=potongan.id_potongan 
        WHERE transaksi_potongan.id_nota_potongan='$_GET[id_nota_potongan]' "); ?>
		<?php while($pecah=$ambil->fetch_assoc()){?>
		<tr>
			<td><?php echo $nomor ?></td>
			<td><?php echo $pecah['nama_potongan']; ?></td>
			<td><?php echo $pecah['keterangan_potongan']; ?></td>
			<td><?php echo $pecah['tanggal_mulai']; ?></td>
			<td><?php echo $pecah['tanggal_selesai'];?></td>
			<td><?php echo $pecah['lama_potongan'];?></td>
			<td>Rp <?php echo number_format ($pecah['sub_total_potongan']);?></td>
			<td>Rp <?php echo number_format ($pecah['cicilan']);?></td>
			
		</tr>
		<?php $nomor++; ?>
		<?php $totalpotongan+=($pecah['cicilan']); ?>
		<?php } ?>
	</tbody>
	<tfoot>
		<tr>
			<th colspan="7"> <center>Total potongan</center>  </th>
			<th>Rp. <?php echo number_format ($totalpotongan) ?>
		</tr>
</table>



	</div>
</section>

	
</body>
</html>