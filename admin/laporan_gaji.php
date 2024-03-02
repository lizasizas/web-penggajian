<?php
include 'config.php';
$id_golongan="";
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
        $tgl_selesai = date("Y-m-d");
    } 
  $tgl_mulai=$_POST['tgl_mulai'];
  $strc[]="slip_gaji.tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai'";
  $jmlh++;
} 

if (isset($_POST['golongan']))
{
    $id_golongan=$_POST['id_golongan'];
    $strc[]="karyawan.golongan='$id_golongan'";
    $jmlh++;
}
if (isset($_POST['keyword']))
{
    $nama_karyawan=$_POST['keyword'];
    $strc[]="karyawan.nama_karyawan LIKE '%$nama_karyawan%'";
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
$query="SELECT *, SUM(slip_gaji.gaji_bersih) AS total FROM slip_gaji inner join karyawan on slip_gaji.id_karyawan = karyawan.id_karyawan
inner join golongan on karyawan.id_golongan=golongan.id_golongan $strw AND slip_gaji.tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai'";
$result=mysqli_query($koneksi,$query);
$resnum=mysqli_num_rows($result);                   
$pecah2=$koneksi->query("SELECT * From golongan");                                  
?>
<div class="row">
    <div class="col-lg-5 col-md-12 col-6 mb-4">

            <!-- Konten Card pertama -->
            <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="assets/img/icons/unicons/wallet-info.png"
                                alt="Credit Card"
                                class="rounded" />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt6"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                <a class="dropdown-item" href="index.php?halaman=laporan_gaji">detail </a>
                                <a class="dropdown-item" href="index.php?halaman=dashboard">kembali </a>
                              </div>
                            </div>
                          </div>
                          <span>Total gaji</span>
                          <?php while($pecah = $result->fetch_assoc()){?>
                            <h3 class="counter card-title text-nowrap mb-1">Rp <?php echo number_format ($pecah['total']); ?></h3>
                            <?php }?>
                        </div>
                      </div>
                      <br>

           

    </div>



    <div class="col-lg-5 col-md-12 col-6 mb-4">
           <!-- Konten Card Kedua -->
           
            
    </div>
</div>



<div class="card shadow mb-4">
<div class="card-header py-3">
<center> <h5 class="m-0 font-weight-bold text-dark">LAPORAN GAJI BERDASARKAN GOLONGAN</h5></center>
</div>
</ol>
</p> 

<form action="index.php?halaman=laporan_gaji" method="post" class="form">
    <br/>
    
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label>Tanggal Mulai :</label>
                <input type="date" class="form-control" name="tgl_mulai" value="<?php echo $tgl_mulai?>" required >
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Tanggal Selesai :</label>
                <input type="date" class="form-control" name="tgl_selesai" value="<?php echo $tgl_selesai?>" required >
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>golongan :</label>
                <select class="form-control" name="id_golongan">
                    <option selected disabled>-- PILIH GOLONGAN -- </option>
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
            <th>Tanggal</th>
            <th>Nama Karyawan</th>
            <th>Golongan </th>
            <th>Gaji Bersih </th>
    </thead>
    <tbody>
        <?php
        $nomor=1;
        while($perproduk=$result->fetch_assoc()){
            ?>
            <tr>
                <th><?php echo $nomor++; ?></th>
                <th><?php echo $perproduk['tanggal']; ?></th>
                <th><?php echo $perproduk['nama_karyawan']; ?></th>
                <th><?php echo $perproduk['nama_golongan']; ?></th>
                <th><?php echo $perproduk['gaji_bersih']; ?></th>
            </tr>
        <?php } ?>
    </tbody>
</table>

