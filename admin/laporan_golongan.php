<?php
include 'config.php';
$id_golongan="";
$strq="";
$strw="";
$jmlh=0;


if (isset($_POST['id_golongan']))
{
    $id_golongan=$_POST['id_golongan'];
    $strc[]="golongan.id_golongan LIKE '%$id_golongan%'";
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
$query="SELECT *, COUNT(karyawan.id_golongan) AS total FROM karyawan inner join golongan on karyawan.id_golongan = golongan.id_golongan $strw 
    GROUP BY karyawan.id_golongan
    ";
$result=mysqli_query($koneksi,$query);
$resnum=mysqli_num_rows($result);                   
$pecah2=$koneksi->query("SELECT * From golongan");                                  
?>



<div class="card shadow mb-4">
<div class="card-header py-3">
<center> <h5 class="m-0 font-weight-bold text-dark">LAPORAN golongan</h5></center>
</div>


<form action="index.php?halaman=laporan_golongan" method="post" class="form">
    <br/>
    
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label>golongan :</label>
                <select class="form-control" name="id_golongan">
                    <option selected disabled>-- PILIH golongan -- </option>
                    <?php while($row = mysqli_fetch_assoc($pecah2)) { ?>
                        <option value="<?php echo $row['id_golongan']; ?>"> <?php echo $row['nama_golongan']; ?></option>
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
            <th>Nama golongan</th>
            <th>total karyawan</th>
    </thead>
    <tbody>
        <?php
        $nomor=1;
        while($perproduk=$result->fetch_assoc()){
            ?>
            <tr>
                <th><?php echo $nomor++; ?></th>
                <th><?php echo $perproduk['nama_golongan']; ?></th>
                <th><?php echo $perproduk['total']; ?></th>
            </tr>
        <?php } ?>
    </tbody>
</table>
</div>
  </div>