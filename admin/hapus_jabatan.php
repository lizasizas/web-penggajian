<?php
include("config.php");
$id_jabatan = $_GET['id_jabatan'];
$sql = "DELETE FROM jabatan WHERE id_jabatan='$id_jabatan'";
$hasil = mysqli_query($koneksi, $sql);
if ($hasil) 
{
	echo "<script>alert('Data berhasil dihapus'); document.location.href='index.php?halaman=jabatan'; </script>";
} 
else 
{
	echo "<script>alert('Proses gagal'); document.location.href='index.php?halaman=jabatan'; </script>";
}
mysqli_close($koneksi);
?>
