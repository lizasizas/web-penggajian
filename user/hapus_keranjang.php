<?php 
session_start ();
$id_potongan=$_GET["id_potongan"];
unset($_SESSION['keranjangpotongan'][$id_potongan]);

echo "<script> alert('potongan dihapus dari keranjang'); </script>";
echo "<script> location='keranjangpotongan.php'; </script>";

?>