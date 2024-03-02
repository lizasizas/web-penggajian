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

<!DOCTYPE html>
<html>
<head>
    <title> Detail Slip Gaji | ZenithSalary</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<BODY STYLE="BACKGROUND-IMAGE:URL(nota.PNG)">

    <?php include'header.php'?>

<section class="detail_slip_gaji">
    <div class="container">
    </br>
</br>
<center><h3> SLIP GAJI</h3></center>
</br>
<?php $id_slip_gaji= $_GET['id_slip_gaji']; ?>
<div class='form-actions'>
    <button  onclick="window.print()"  class="btn btn-success"><i class="fa fa-print"></i> Cetak</button>
</div>
<br>

<?php 
$ambil=$koneksi->query("SELECT * FROM slip_gaji
    JOIN karyawan ON slip_gaji.id_karyawan = karyawan.id_karyawan 
    JOIN golongan ON karyawan.id_golongan=golongan.id_golongan 
    JOIN jabatan ON karyawan.id_jabatan=jabatan.id_jabatan 
    JOIN divisi ON karyawan.id_divisi=divisi.id_divisi where id_slip_gaji='$id_slip_gaji'");?>
    <?php while($p = $ambil->fetch_assoc()){?>
        <table class='table'>
            <tbody>
                <tr>
                    <td style="width: 25%;">ID Slip Gaji</td>
                    <td>:  <?php echo $id_slip_gaji;?></td>
                </tr>
                <tr>
                    <td style="width: 25%;">Nama Karyawan</td>
                    <td>:  <?php echo $p['nama_karyawan'];?></td>
                </tr>
                <tr>
                    <td style="width: 25%;">Jabatan</td>
                    <td>:  <?php echo $p['nama_jabatan'];?></td>
                </tr>
                <tr>
                    <td style="width: 25%;">Divisi</td>
                    <td>:  <?php echo $p['nama_divisi'];?></td>
                </tr>
                <tr>
                    <td style="width: 25%;">Golongan</td>
                    <td>:  <?php echo $p['nama_golongan']; ?></td>
                </tr>
            </tbody>
        </table>
        <?php 
        $tanggal = $p['tanggal'];
        $id_karyawan = $p['id_karyawan'];
        $gaji_pokok = $p['gaji_pokok'];
        $tunjanganjabatan = $p['tunjangan_jabatan'];
        $gaji_bersih = $p['gaji_bersih'];
        $nama=$p['nama_jabatan'];
    } ?>
    <table class='table'>
        <thead>
            <tr>
                <th>Uraian</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr class='danger'>
                <td><b>Gaji Pokok : <b></td>
                    <td><b>Rp <?php echo number_format("$gaji_pokok"); ?></b></td>
                </tr>
                <tr>

                            <?php 
                            $total_potongan = 0;
                            $total_tunjangan = 0;
                             //ambil data tunjangan untuk ditampilkan 
                            $ambildatat = $koneksi->query("SELECT * FROM transaksi_tunjangan
                                JOIN nota_tunjangan ON nota_tunjangan.id_nota_tunjangan = transaksi_tunjangan.id_nota_tunjangan 
                                JOIN tunjangan ON transaksi_tunjangan.id_tunjangan = tunjangan.id_tunjangan
                                WHERE nota_tunjangan.id_karyawan = '$id_karyawan' AND nota_tunjangan.id_verifikasi = 'IDV01'");
                                ?>
                               <td><b>TUNJANGAN<b></td>
                                    <td></td>
                                </tr>
                                  <tr class='danger'>
                                    <td>Tunjangan Jabatan</td>
                                    <td> Rp <?php echo number_format($tunjanganjabatan); ?></td> </tr>
                                      <?php while ($pecahdt = $ambildatat->fetch_assoc()){  ?>
                                     <tr class='danger'>
                                        <td><?php echo $pecahdt['nama_tunjangan'] ?></td>
                                        <td>Rp <?php echo number_format($pecahdt['sub_total_tunjangan']);?></td>
                                        <?php $total_tunjangan += $pecahdt['sub_total_tunjangan']; ?>
                                        <?php $total_t = $total_tunjangan+$tunjanganjabatan ;?>
                                    <?php } ?>    
                                </tr>
                                <tr>
                                    <td><b>Total Tunjangan : <b></td>
                                        <td><b>Rp <?php echo number_format("$total_t"); ?></b></td>
                                    </tr>
                                    <?php 
                                    
                                        //ngambil potongan untuk ditampilkan
                                    $ambildatap = $koneksi->query("SELECT * FROM transaksi_potongan 
                                        JOIN nota_potongan ON nota_potongan.id_nota_potongan = transaksi_potongan.id_nota_potongan 
                                        JOIN potongan ON transaksi_potongan.id_potongan = potongan.id_potongan 
                                        WHERE nota_potongan.id_karyawan = '$id_karyawan' AND '$tanggal' BETWEEN tanggal_mulai AND tanggal_selesai AND id_verifikasi = 'IDV01'");
                                        ?>
                                        <td><b>POTONGAN<b></td>
                                            <td></td>
                                        </tr>
                                        <?php while ($pecahdp = $ambildatap->fetch_assoc()){  ?>
                                            <tr class='danger'>
                                                <td><?php echo $pecahdp['nama_potongan'] ?></td>
                                                <td>- Rp <?php echo number_format($pecahdp['cicilan']);?></td>
                                                <?php $total_potongan += $pecahdp['cicilan']; ?>
                                            <?php } ?>    
                                        </tr>
                                        <tr>
                                            <td><b>Total Potongan : <b></td>
                                                <td><b>- Rp <?php echo number_format("$total_potongan"); ?></b></td>
                                            </tr>

                                    <tr>
                                        <td><b>Total Gaji Bersih</b></td>

                                        <td><b> Rp <?php echo number_format("$gaji_bersih"); ?> </b></td>
                                    </tr>
                                </tbody>
                            </table>
                            </section>
                        </body>

                        </html>
</body>

</html>