<?php
include("config.php");
$id_status = $_GET['id_status'];
$sql = "DELETE FROM status_potongan WHERE id_status='$id_status'";
$hasil = mysqli_query($koneksi, $sql);
if ($hasil) 
{
	echo "<script>alert('Data berhasil dihapus'); document.location.href='index.php?halaman=status_potongan'; </script>";
} 
else 
{
	echo "<script>alert('Proses gagal'); document.location.href='index.php?halaman=status_potongan'; </script>";
}
mysqli_close($koneksi);
?>
