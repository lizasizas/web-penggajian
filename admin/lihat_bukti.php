<?php 
$sql=$koneksi->query("SELECT * FROM nota_tunjangan WHERE id_nota_tunjangan='$_GET[id_nota_tunjangan]'");
$detail=$sql->fetch_assoc();
?>


<embed type="application/pdf" src="../bukti_verifikasi/<?php echo $detail['File'];?>" width="1000" height="1000"></embed>