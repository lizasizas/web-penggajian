<?php 
session_start ();
$id_tunjangan=$_GET["id_tunjangan"];
unset($_SESSION['keranjang_tunjangan'][$id_tunjangan]);

echo "<script> alert('tunjangan dihapus dari keranjang'); </script>";
echo "<script> location='keranjang_tunjangan.php'; </script>";

?>