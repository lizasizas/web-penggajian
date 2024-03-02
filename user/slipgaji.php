<?php $koneksi=new mysqli("localhost","root","","zenithsalary");
session_start();
 if(!isset($_SESSION["karyawan"]))
    {
        echo "<script>alert('Silahkan Login');</script>";
        echo "<script>location='login.php';</script>";
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Slip Gaji | ZenithSalary</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<BODY STYLE="BACKGROUND-IMAGE:URL(nota.PNG)">

<?php include'header.php'?>

<section class="slipgaji">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <br>
            <br>
                <div style="color: black">
                    <center><h2>Daftar Slip Gaji <?php echo $_SESSION["karyawan"]["nama_karyawan"]?></h2></center>
                </div>
            </div>
        </div>

    <table class="table">
            <thead>
                <tr>
                    <th><center>No</th>
                    <th><center>No Slip</th>
                    <th><center>Tanggal Pembayaran</th>
                    <th><center>Actions</th>

                </tr>
            </thead>
            <tbody>
                <?php $nomor=1;?>
                <?php
                    //mendapatkan id pelanggan yg login dari session
                    $id_karyawan = $_SESSION["karyawan"]["id_karyawan"];
                    $ambil = $koneksi->query("SELECT * FROM slip_gaji
                     JOIN karyawan ON slip_gaji.id_karyawan = karyawan.id_karyawan
                     WHERE slip_gaji.id_karyawan='$id_karyawan'");?>
                    <?php while($pecah = $ambil->fetch_assoc()){?>
                <tr>
                    <td><center><?php echo $nomor;?></td>
                    <td><center><?php echo $pecah["id_slip_gaji"]; ?></td>
                    <td><center><?php echo date("d F Y",strtotime($pecah["tanggal"])); ?></td>
                    <td class='action'>
                    <center><a href="detailslipgaji.php?halaman=detailslipgaji&id_slip_gaji=<?php echo $pecah["id_slip_gaji"]; ?>" class="btn btn-info">Slip Gaji</a>
                    </td>
                </tr>
                <?php $nomor++; ?>
                <?php } ?>
            </tbody>
        </table>
    

    </div>
</section>

</body>

</html>