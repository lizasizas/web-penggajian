<?php
include 'config.php';
$id_status_nikah="";
$strq="";
$strw="";
$jmlh=0;


if (isset($_POST['id_status_nikah']))
{
    $id_status_nikah=$_POST['id_status_nikah'];
    $strc[]="status_nikah.id_status_nikah LIKE '%$id_status_nikah%'";
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
$query="SELECT *, COUNT(karyawan.id_status_nikah) AS total FROM karyawan inner join status_nikah on karyawan.id_status_nikah = status_nikah.id_status_nikah $strw 
    GROUP BY karyawan.id_status_nikah
    ";
$result=mysqli_query($koneksi,$query);
$resnum=mysqli_num_rows($result);                   
$pecah2=$koneksi->query("SELECT * From status_nikah");                                  
?>
<div class="row">
    <div class="col-lg-5 col-md-12 col-6 mb-4">

            



    <div class="col-lg-5 col-md-12 col-6 mb-4">
           <!-- Konten Card Kedua -->
           
            
    </div>
</div>



<div class="card shadow mb-4">
<div class="card-header py-3">
<center> <h5 class="m-0 font-weight-bold text-dark">LAPORAN status_nikah</h5></center>
</div>
</ol>
</p> 

<form action="index.php?halaman=laporan_status_nikah" method="post" class="form">
    <br/>
    
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label>status_nikah :</label>
                <select class="form-control" name="id_status_nikah">
                    <option selected disabled>-- PILIH status_nikah -- </option>
                    <?php while($row = mysqli_fetch_assoc($pecah2)) { ?>
                        <option value="<?php echo $row['id_status_nikah']; ?>"> <?php echo $row['nama_status_nikah']; ?></option>
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
            <th>Nama status_nikah</th>
            <th>total karyawan</th>
    </thead>
    <tbody>
        <?php
        $nomor=1;
        while($perproduk=$result->fetch_assoc()){
            ?>
            <tr>
                <th><?php echo $nomor++; ?></th>
                <th><?php echo $perproduk['nama_status_nikah']; ?></th>
                <th><?php echo $perproduk['total']; ?></th>
            </tr>
        <?php } ?>
    </tbody>
</table>
                            </div>
                            </div>
                            </div>