<?php
include("config.php");
$id_tunjangan = $_GET['id_tunjangan'];
$sql = "DELETE FROM tunjangan WHERE id_tunjangan='$id_tunjangan'";
$hasil = mysqli_query($koneksi, $sql);
if ($hasil) 
{
	echo "<script>alert('Data berhasil dihapus'); document.location.href='index.php?halaman=tunjangan'; </script>";
} 
else 
{
	echo "<script>alert('Proses gagal'); document.location.href='index.php?halaman=tunjangan'; </script>";
}
mysqli_close($koneksi);
?>
