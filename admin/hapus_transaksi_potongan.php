<?php
include("config.php");
$id_potongan = $_GET['id_potongan'];
$sql = "DELETE FROM transaksi_potongan WHERE id_potongan='$id_potongan'";
$hasil = mysqli_query($koneksi, $sql);
if ($hasil) 
{
	echo "<script>alert('Data berhasil dihapus'); document.location.href='index.php?halaman=ubah_daftar_potongan'; </script>";
} 
else 
{
	echo "<script>alert('Proses gagal'); document.location.href='index.php?halaman=ubah_daftar_potongan'; </script>";
}
mysqli_close($koneksi);
?>
