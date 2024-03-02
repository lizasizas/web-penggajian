<?php
include("config.php");
$id_verifikasi = $_GET['id_verifikasi'];
$sql = "DELETE FROM verifikasi WHERE id_verifikasi='$id_verifikasi'";
$hasil = mysqli_query($koneksi, $sql);
if ($hasil) 
{
	echo "<script>alert('Data berhasil dihapus'); document.location.href='index.php?halaman=verifikasi'; </script>";
} 
else 
{
	echo "<script>alert('Proses gagal'); document.location.href='index.php?halaman=verifikasi'; </script>";
}
mysqli_close($koneksi);
?>
