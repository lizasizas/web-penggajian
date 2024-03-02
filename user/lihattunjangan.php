<head>
	<title>Riwayat Pengajuan | ZenithSalary</title>
</head>
<?php
session_start();
include("config.php");
include("header.php");

    $sql=$koneksi->query("SELECT * FROM nota_tunjangan WHERE id_nota_tunjangan='$_GET[id_nota_tunjangan]'");
	$detail=$sql->fetch_assoc();
	?>


	<embed type="application/pdf" src="../bukti_verifikasi/<?php echo $detail['lampiran_tunjangan'];?>" width="1260" height="1000"></embed>