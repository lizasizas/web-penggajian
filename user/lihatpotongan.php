<head>
	<title>Riwayat Pengajuan | ZenithSalary</title>
</head>
<?php
session_start();
include("config.php");
include("header.php");

    $sql=$koneksi->query("SELECT * FROM nota_potongan WHERE id_nota_potongan='$_GET[id_nota_potongan]'");
	$detail=$sql->fetch_assoc();
	?>


	<embed type="application/pdf" src="../bukti_verifikasi/<?php echo $detail['lampiran_potongan'];?>" width="1260" height="1000"></embed>