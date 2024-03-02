<?php
session_start ();
$db_host="localhost";
$db_user="root";
$db_pass="";
$db_name="zenithsalary";
$koneksi=mysqli_connect($db_host,$db_user,$db_pass,$db_name);

$strq="";
$strw="";
$jmlh=0;
$tgl_mulai="";
$tgl_selesai="";

if (isset($_POST['tgl_mulai']))
{
    if (isset($_POST['tgl_selesai']))
    {
        $tgl_selesai=$_POST['tgl_selesai'];
    }
    else
    {
        $tgl_selesai=date("Y-m-d");
    }
   if (!empty($tgl_mulai)) {
    $strc[] = "slip_gaji.tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai'";
    $jmlh++;
}
} 
$query="SELECT * FROM slip_gaji
                 JOIN karyawan ON slip_gaji.id_karyawan=karyawan.id_karyawan $strw";
$result=mysqli_query($koneksi,$query);
$resnum=mysqli_num_rows($result);                   
$pecah2=$koneksi->query("SELECT * From karyawan 
                 join jabatan on karyawan.id_jabatan=jabatan.id_jabatan
                 join golongan on karyawan.id_karyawan=golongan.id_golongan
                 join divisi on karyawan.id_divisi=divisi.id_divisi");                                            
?>

<?php include'header.php'?>

<form action="slipgaji.php" method="post" class="form">
<section class="daftartunjangan">
    <div class="container">
        <form action="slipgaji.php" method="post" class="form">
    <br/>
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label>Tanggal Mulai :</label>
                <input type="date" class="form-control" name="tgl_mulai" value="<?php echo $tgl_mulai?>" required >
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Tanggal Selesai :</label>
                <input type="date" class="form-control" name="tgl_selesai" value="<?php echo $tgl_selesai?>" required >
            </div>
        </div>
        <div class="col-md-2">
            <br/>
            <input type="submit" class="btn btn-primary mb-4" name="submit" value="Search">
        </div>
    </div>
    <br/><br/>
</form>


<?php  
if (isset($_POST['submit'])) { 
    // Use the correct names for form fields (tgl_mulai and tgl_selesai)
    $tgl_mulai = isset($_POST['tgl_mulai']) ? $_POST['tgl_mulai'] : '';
    $tgl_selesai = isset($_POST['tgl_selesai']) ? $_POST['tgl_selesai'] : date("Y-m-d");

    // ... rest of the code ...

    if (!empty($tgl_mulai)) { 
        // Only add the date range condition if tgl_mulai is not empty
        $strc[] = "slip_gaji.tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai'";
        $jmlh++;
    }

    // ... rest of the code ...
}
?>

            <?php $totaljabatan=0;?>
            <?php $totaldivisi=0;?>
            <?php $totalgolongan=0;?>
            <?php $totaltransaksipotongan=0;?>
            <?php $totaltransaksitunjangan=0;?>
            <?php  
            if(isset($_POST['submit'])) 
            {
                    $id_karyawan= $_SESSION["karyawan"]['id_karyawan'];
                    $ambil = $koneksi->query("SELECT * FROM karyawan
                     JOIN jabatan ON karyawan.id_jabatan=jabatan.id_jabatan
                     JOIN divisi ON karyawan.id_divisi=divisi.id_divisi
                     JOIN golongan ON karyawan.id_golongan=golongan.id_golongan
                     WHERE id_karyawan = '$id_karyawan'");
                     while($p=$ambil->fetch_assoc()){  
            ?>
<center><h2> Slip Gaji U-Wages Company</h2></center>
<div class="container">
            <table class=" table">
                <tbody>
                <tr><td>Nama Karyawan    : <?php echo $p['nama_karyawan'];?></td></tr>
                <tr><td>Jabatan    : <?php echo $p['nama_jabatan'];?></td></tr>
                <tr><td>Divisi    : <?php echo $p['nama_divisi'];?></td></tr>
                <tr><td>Golongan    : <?php echo $p['nama_golongan'];?></td></tr>
            </table>
             <?php } ?>

            <?php
                    $id_karyawan= $_SESSION["karyawan"]['id_karyawan'];
                    $ambil = $koneksi->query("SELECT * FROM slip_gaji
                     WHERE id_karyawan = '$id_karyawan'");
                     while($p=$ambil->fetch_assoc()){  
            ?>

            <table class=" table">
                <tbody>
                <tr><td>Tanggal    : <?php echo $p['tanggal'];?></td></tr>
            </tbody>
            </table>
            <?php } ?>

            <table class='table'>
            <thead>
              <tr>
                            <th>Uraian</th>
                            <th>Jumlah</th>
              </tr>
            </thead>

            <tr>
                  <?php
            $id_karyawan= $_SESSION["karyawan"]['id_karyawan'];
             $ambil=$koneksi->query("SELECT * FROM karyawan
                join jabatan on karyawan.id_jabatan=jabatan.id_jabatan
                WHERE id_karyawan = '$id_karyawan'");
            while($pecah=$ambil->fetch_assoc()){?>
              <tr class='danger'>
                <td>Tunjangan Jabatan : <?php echo $pecah['nama_jabatan']; ?> </td>
                 <td>Rp. <?php echo number_format ($pecah['tunjangan_jabatan']); ?> </td>
              </tr>
              <?php $totaljabatan+=($pecah['tunjangan_jabatan']); ?>
            <?php }?>  

             </tr>

             <tr>
                  <?php
            $id_karyawan= $_SESSION["karyawan"]['id_karyawan'];
             $ambil=$koneksi->query("SELECT * FROM karyawan
                join divisi on karyawan.id_divisi=divisi.id_divisi
                WHERE id_karyawan = '$id_karyawan'");
            while($pecah=$ambil->fetch_assoc()){?>
              <tr class='danger'>
                 <td>Tunjangan Divisi : <?php echo $pecah['nama_divisi']; ?> </td>
                 <td>Rp. <?php echo number_format ($pecah['tunjangan_divisi']); ?> </td>
              </tr>
              <?php $totaldivisi+=($pecah['tunjangan_divisi']); ?>
            <?php }?>  

             </tr>


             <tr>
                  <?php
            $id_karyawan= $_SESSION["karyawan"]['id_karyawan'];
             $ambil=$koneksi->query("SELECT * FROM karyawan
                join golongan on karyawan.id_golongan=golongan.id_golongan
                WHERE id_karyawan = '$id_karyawan'");
            while($pecah=$ambil->fetch_assoc()){?>
              <tr class='danger'>
                <td>Gaji Pokok </td>
                 <td>Rp. <?php echo number_format ($pecah['tunjangan_golongan']); ?> </td>
              </tr>
              <?php $totalgolongan+=($pecah['tunjangan_golongan']); ?>
            <?php }?>  

             </tr>

             <tbody>
            <?php
            $id_karyawan= $_SESSION["karyawan"]['id_karyawan'];
             $ambil=$koneksi->query("SELECT * FROM transaksi_tunjangan
                JOIN daftar_tunjangan ON transaksi_tunjangan.id_daftar_tunjangan=daftar_tunjangan.id_daftar_tunjangan
                JOIN tunjangan ON transaksi_tunjangan.id_tunjangan=tunjangan.id_tunjangan
                WHERE id_karyawan = '$id_karyawan'");
            while($pecah=$ambil->fetch_assoc()){?>
              <tr class='danger'>
                <td><?php echo $pecah['nama_tunjangan']; ?> </td>
                 <td>Rp. <?php echo number_format ($pecah['sub_total_tunjangan']); ?> </td>
              </tr>
              <?php $totaltransaksitunjangan+=($pecah['sub_total_tunjangan']); ?>
            <?php }?>
            </tbody>

            <tr>
            <?php
            $id_karyawan= $_SESSION["karyawan"]['id_karyawan'];
             $ambil=$koneksi->query("SELECT * FROM transaksi_potongan
                JOIN daftar_potongan ON transaksi_potongan.id_daftar_potongan=daftar_potongan.id_daftar_potongan
                JOIN potongan ON transaksi_potongan.id_potongan=potongan.id_potongan
                WHERE id_karyawan = '$id_karyawan'");
            while($pecah=$ambil->fetch_assoc()){?>
              <tr class='danger'>
                <td>- <?php echo $pecah['nama_potongan'] ; ?> </td>
                 <td>- Rp. <?php echo number_format ($pecah['sub_total_potongan']); ?> </td>
              </tr>
              <?php $totaltransaksipotongan+=($pecah['sub_total_potongan']); ?>
            <?php }?>
            </tr>

             <?php $totaltunjangan=($totaljabatan+$totaldivisi+$totalgolongan+$totaltransaksitunjangan); ?>
             <?php $totalpotongan=($totaltransaksipotongan); ?>
             <?php $p['total_gaji']=($totaltunjangan-$totalpotongan); ?>

              <tr>
                <th> Total Gaji </th>
                <th>Rp. <?php echo number_format ($totalgaji) ?>
              </tr>
        </table>
        <div class='form-actions'>
          <button  onclick="window.print()"  class="btn btn-success"><i class="fa fa-print"></i> Cetak</button>
        </div>
        <tr><tr></tr></tr>
        <?php }
  ?>
      </div>
</section>




</body>
</html>
  