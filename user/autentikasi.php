<?php
session_start();
include('config.php');
$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($koneksi,"SELECT * FROM karyawan WHERE username='$username' AND password='$password'");
if(mysqli_num_rows($query)==1){
    // sukses login
    $karyawan = mysqli_fetch_array($query);
    $_SESSION['karyawan'] = $karyawan;
    echo "<script> alert('Login Sukses');</script>";
    echo "<script> location ='../user';</script>";
}
else if($username=='' || $password==''){
    header('Location:index.php?error=2');
}
else{
    header('Location:index.php?error=1');
}
?>