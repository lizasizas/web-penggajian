<?php
session_start();

//mendapatkan kode_pot dari url ecode

$id_tunjangan= $_GET['id_tunjangan'];

// Jika sudah ada menu tersebut dikeranjang, maka jumlah menu +1
if (isset($_SESSION['keranjang_tunjangan'][$id_tunjangan]))
{
	$_SESSION['keranjang_tunjangan'][$id_tunjangan]+=1;
}
// Namun jika belum ada, maka anggap bahwa 1
else 
{
	$_SESSION['keranjang_tunjangan'][$id_tunjangan]=1;
}

//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";

//larikan ke halaman keranjang
echo "<script>alert('Menu telah dimasukkan kedalam keranjang'); </script>";
echo "<script>location='ajukantunjangan.php'; </script>";
?>