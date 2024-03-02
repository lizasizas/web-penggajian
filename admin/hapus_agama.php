<?php
include("config.php");
$id_agama = $_GET['id_agama'];
$sql = "DELETE FROM agama WHERE id_agama='$id_agama'";
$hasil = mysqli_query($koneksi, $sql);
if ($hasil) 
{
	echo "<script>alert('Data berhasil dihapus'); document.location.href='index.php?halaman=agama'; </script>";
} 
else 
{
	echo "<script>alert('Proses gagal'); document.location.href='index.php?halaman=agama'; </script>";
}
mysqli_close($koneksi);
?>
