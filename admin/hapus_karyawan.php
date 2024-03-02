<?php
include("config.php");
$id_karyawan = $_GET['id_karyawan'];
$sql = "DELETE FROM karyawan WHERE id_karyawan='$id_karyawan'";
$hasil = mysqli_query($koneksi, $sql);
if ($hasil) 
{
	echo "<script>alert('Data berhasil dihapus'); document.location.href='index.php?halaman=karyawan'; </script>";
} 
else 
{
	echo "<script>alert('Proses gagal'); document.location.href='index.php?halaman=karyawan'; </script>";
}
mysqli_close($koneksi);
?>
