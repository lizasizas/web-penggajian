<?php
session_start();
$Kode_Menu=$_GET["id_potongan"];
var_dump($Kode_Menu);
unset ($_SESSION["keranjangpotongan"][$Kode_Menu]);

echo "<script>alert('Menu telah dihapus dari keranjang');</script>";
echo "<script>location='keranjangpotongan.php';</script>";

?>