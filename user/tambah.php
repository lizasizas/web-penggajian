<?php
session_start();

//mendapatkan kode_pot dari url ecode

$kode_pot= $_GET['id_potongan'];

// Jika sudah ada menu tersebut dikeranjang, maka jumlah menu +1
if (isset($_SESSION['keranjang'][$kode_pot]))
{
	$_SESSION['keranjang'][$kode_pot]+=1;
}
// Namun jika belum ada, maka anggap bahwa 1
else 
{
	$_SESSION['keranjang'][$kode_pot]=1;
}

//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";

//larikan ke halaman keranjang
echo "<script>alert('Menu telah dimasukkan kedalam keranjang'); </script>";
echo "<script>location='ajukanpotongan.php'; </script>";
?>