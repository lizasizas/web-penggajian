<?php
include("config.php");
$id_divisi = $_GET['id_divisi'];
$sql = "DELETE FROM divisi WHERE id_divisi='$id_divisi'";
$hasil = mysqli_query($koneksi, $sql);
if ($hasil) 
{
	echo "<script>alert('Data berhasil dihapus'); document.location.href='index.php?halaman=divisi'; </script>";
} 
else 
{
	echo "<script>alert('Proses gagal'); document.location.href='index.php?halaman=divisi'; </script>";
}
mysqli_close($koneksi);
?>
