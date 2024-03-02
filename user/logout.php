<?php
session_start();

//menghancurkan $SESSION["pelanggan"]
session_destroy();

echo "<script>alert('Anda telah logout');</script>";
echo "<script>location='../homepage/index.php'; </script>";
?>