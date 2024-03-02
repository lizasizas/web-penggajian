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
$query="SELECT *, SUM(slip_gaji.gaji_bersih) AS total FROM slip_gaji 
    inner join karyawan on karyawan.id_karyawan = slip_gaji.id_karyawan  
    inner join jabatan on karyawan.id_jabatan = jabatan.id_jabatan $strw 
    GROUP BY karyawan.id_jabatan";
$result=mysqli_query($koneksi,$query);
$resnum=mysqli_num_rows($result);                   
$pecah2=$koneksi->query("SELECT * From jabatan");                                  
?>



<h4><span class="text-muted fw-light"> LAPORAN |</span> GAJI BERDASARKAN JABATAN</h4>
<div>

<form action="index.php?halaman=laporan_gaji_jabatan" method="post" class="form">
    
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label></label>
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
</form>
<div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-light" id="dataTable" width="100%" cellspacing="50" style="background-color:white;">
    <thead>
            <th>Nomor</th>
            <th>Nama jabatan</th>
            <th>Total Gaji</th>
    </thead>
    <tbody>
        <?php
        $nomor=1;
        $total = 0;
        while($perproduk=$result->fetch_assoc()){
            ?>
            <tr>
                <th><?php echo $nomor; ?></th>
                <th><?php echo $perproduk['nama_jabatan']; ?></th>
                <th>Rp <?php echo number_format ($perproduk['total']); ?></th>
            </tr>
            <?php
            $nomor++;
            $total += ($perproduk['total']);
            } ?>
            <tr>
                <th colspan="2"><center>Total </th>
                <th>Rp <?php echo number_format($total) ?></th>
            </tr>
    </tbody>
</table>
        </div>
        </div>