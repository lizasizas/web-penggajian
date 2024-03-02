<?php
include("config.php");
$id_golongan = $_GET['id_golongan'];
$sql = "DELETE FROM golongan WHERE id_golongan='$id_golongan'";
$hasil = mysqli_query($koneksi, $sql);
if ($hasil) 
{
	echo "<script>alert('Data berhasil dihapus'); document.location.href='index.php?halaman=golongan'; </script>";
} 
else 
{
	echo "<script>alert('Proses gagal'); document.location.href='index.php?halaman=golongan'; </script>";
}
mysqli_close($koneksi);
?>
