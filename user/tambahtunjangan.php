<?php
session_start();

//mendapatkan kode_pot dari url ecode

$kode_pot= $_GET['id_tunjangan'];

// Jika sudah ada menu tersebut dikeranjang, maka jumlah menu +1
if (isset($_SESSION['keranjangtunjangan'][$kode_pot]))
{
	$_SESSION['keranjangtunjangan'][$kode_pot]+=1;
}
// Namun jika belum ada, maka anggap bahwa 1
else 
{
	$_SESSION['keranjangtunjangan'][$kode_pot]=1;
}

//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";

//larikan ke halaman keranjang
echo "<script>alert('Pilihan tunjangan telah dipilih'); </script>";
echo "<script>location='ajukantunjangan.php'; </script>";
?>