<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "zenithsalary";

$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
session_start();

if(!isset($_SESSION["karyawan"]))
{
  echo "<script>alert('Anda Harus Login Terlebih Dahulu');</script>";
  echo "<script>location='../loginuser/autentikasi.php';</script>";
}
?>

<form action="proses_form.php" method="post">
    <?php
    // Data yang akan digunakan untuk nilai checkbox
    $data_checkbox = array("Nilai 1", "Nilai 2", "Nilai 3", "Nilai 4", "Nilai 5");

    // Loop untuk membuat checkbox
    foreach ($data_checkbox as $nilai) {
        echo '<input type="checkbox" name="checkbox[]" value="' . $nilai . '"> ' . $nilai . '<br>';
    }
    ?>
    <input type="submit" value="Kirim">
</form>

</body>
</html>