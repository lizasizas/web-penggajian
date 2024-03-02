<?php
include("config.php");
$id_nota_tunjangan = $_GET['id_nota_tunjangan'];
$sql = "DELETE FROM nota_tunjangan WHERE id_nota_tunjangan='$id_nota_tunjangan'";
$hasil = mysqli_query($koneksi, $sql);
if ($hasil) 
{
	echo "<script>alert('Data berhasil dihapus'); document.location.href='index.php?halaman=nota_tunjangan'; </script>";
} 
else 
{
	echo "<script>alert('Proses gagal'); document.location.href='index.php?halaman=nota_tunjangan'; </script>";
}
mysqli_close($koneksi);
?>
