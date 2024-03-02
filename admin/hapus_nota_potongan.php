<?php
include("config.php");
$id_nota_potongan = $_GET['id_nota_potongan'];
$sql = "DELETE FROM nota_potongan WHERE id_nota_potongan='$id_nota_potongan'";
$hasil = mysqli_query($koneksi, $sql);
if ($hasil) 
{
	echo "<script>alert('Data berhasil dihapus'); document.location.href='index.php?halaman=nota_potongan'; </script>";
} 
else 
{
	echo "<script>alert('Proses gagal'); document.location.href='index.php?halaman=nota_potongan'; </script>";
}
mysqli_close($koneksi);
?>
