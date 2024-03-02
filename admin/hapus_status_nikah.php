<?php
include("config.php");
$id_status_nikah = $_GET['id_status_nikah'];
$sql = "DELETE FROM status_nikah WHERE id_status_nikah='$id_status_nikah'";
$hasil = mysqli_query($koneksi, $sql);
if ($hasil) 
{
	echo "<script>alert('Data berhasil dihapus'); document.location.href='index.php?halaman=status_nikah'; </script>";
} 
else 
{
	echo "<script>alert('Proses gagal'); document.location.href='index.php?halaman=status_nikah'; </script>";
}
mysqli_close($koneksi);
?>
