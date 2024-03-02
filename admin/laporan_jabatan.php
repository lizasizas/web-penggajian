<?php
include 'config.php';
$id_jabatan="";
$strq="";
$strw="";
$jmlh=0;


if (isset($_POST['id_jabatan']))
{
    $id_jabatan=$_POST['id_jabatan'];
    $strc[]="jabatan.id_jabatan LIKE '%$id_jabatan%'";
    $jmlh++;
} 

$i=1;
if($jmlh>0)
{
    $strw="WHERE ";
    foreach ($strc as $strs)
    {
        $strw .=$strs;
        if($i<$jmlh)
        {
            $strw .=" AND ";
            $i++;
        }
    }
}
$query="SELECT *, COUNT(karyawan.id_jabatan) AS total FROM karyawan inner join jabatan on karyawan.id_jabatan = jabatan.id_jabatan $strw 
    GROUP BY karyawan.id_jabatan
    ";
$result=mysqli_query($koneksi,$query);
$resnum=mysqli_num_rows($result);                   
$pecah2=$koneksi->query("SELECT * From jabatan");                                  
?>
<div class="card shadow mb-1">
<div class="card-header py-2">
<center> <h5 class="m-0 font-weight-bold text-dark">LAPORAN JABATAN</h5></center>
</div>

<form action="index.php?halaman=laporan_jabatan" method="post" class="form">
    <br/>
    
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label>jabatan :</label>
                <select class="form-control" name="id_jabatan">
                    <option selected disabled>-- PILIH jabatan -- </option>
                    <?php while($row = mysqli_fetch_assoc($pecah2)) { ?>
                        <option value="<?php echo $row['id_jabatan']; ?>"> <?php echo $row['nama_jabatan']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <br/>
            <input type="submit" class="btn btn-primary mb-4" name="submit" value="Search">
        </div>
    </div>
    <br/><br/>
</form>
<div class="card-body">
  <div class="table-responsive">
  <table class="table table-bordered text-light" id="dataTable" width="100%" cellspacing="50" style="background-color:white;">
    <thead>
            <th>Nomor</th>
            <th>Nama jabatan</th>
            <th>total karyawan</th>
    </thead>
    <tbody>
        <?php
        $nomor=1;
        while($perproduk=$result->fetch_assoc()){
            ?>
            <tr>
                <th><?php echo $nomor++; ?></th>
                <th><?php echo $perproduk['nama_jabatan']; ?></th>
                <th><?php echo $perproduk['total']; ?></th>
            </tr>
        <?php } ?>
    </tbody>
</table>
  </div>
  </div>