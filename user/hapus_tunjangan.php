<?php
session_start();
$Kode_Menu=$_GET["id_tunjangan"];
var_dump($Kode_Menu);
unset ($_SESSION["keranjangtunjangan"][$Kode_Menu]);

echo "<script>alert('Pilihan tunjangan telah dihapus');</script>";
echo "<script>location='keranjangtunjangan.php';</script>";

?>