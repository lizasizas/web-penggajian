<?php
session_start(); 
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "zenithsalary";

$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
?>

<?php include 'header.php';?>

<!-- banner -->
<div class="banner">    	   
    <img src="images/photos/banner.jpg"  class="img-responsive" alt="slide">
    <div class="welcome-message">
        <div class="wrap-info">
            <div class="information">
                <h1  class="animated fadeInDown">U-Wages Company</h1>
                <p class="animated fadeInUp">order boarding from home</p>                
            </div>
        </div>
    </div>
</div>
<!-- banner-->
