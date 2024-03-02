<?php
include 'config.php';
$id_agama="";
$strq="";
$strw="";
$jmlh=0;


if (isset($_POST['id_agama']))
{
    $id_agama=$_POST['id_agama'];
    $strc[]="agama.id_agama LIKE '%$id_agama%'";
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
$query="SELECT *, COUNT(karyawan.id_agama) AS total FROM karyawan inner join agama on karyawan.id_agama = agama.id_agama $strw 
    GROUP BY karyawan.id_agama
    ";
$result=mysqli_query($koneksi,$query);
$resnum=mysqli_num_rows($result);                   
$pecah2=$koneksi->query("SELECT * From agama");                                  
?>
<div class="row">
    <div class="col-lg-5 col-md-12 col-6 mb-4">

            



    <div class="col-lg-5 col-md-12 col-6 mb-4">
           <!-- Konten Card Kedua -->
           
            
    </div>
</div>



<div class="card shadow mb-4">
<div class="card-header py-3">
<center> <h5 class="m-0 font-weight-bold text-dark">LAPORAN agama</h5></center>
</div>
</ol>
</p> 

<form action="index.php?halaman=laporan_agama" method="post" class="form">
    <br/>
    
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label>agama :</label>
                <select class="form-control" name="id_agama">
                    <option selected disabled>-- PILIH agama -- </option>
                    <?php while($row = mysqli_fetch_assoc($pecah2)) { ?>
                        <option value="<?php echo $row['id_agama']; ?>"> <?php echo $row['nama_agama']; ?></option>
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
            <th>Nama agama</th>
            <th>total karyawan</th>
    </thead>
    <tbody>
        <?php
        $nomor=1;
        while($perproduk=$result->fetch_assoc()){
            ?>
            <tr>
                <th><?php echo $nomor++; ?></th>
                <th><?php echo $perproduk['nama_agama']; ?></th>
                <th><?php echo $perproduk['total']; ?></th>
            </tr>
        <?php } ?>
    </tbody>
</table>
</div>
  </div>
  </div>