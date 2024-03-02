<?php
include 'config.php';
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
  $tgl_mulai=$_POST['tgl_mulai'];
  $strc[]="slip_gaji.tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai' ";
  $jmlh++;
}
if (isset($_POST['keyword']))
{
  $keyword=$_POST['keyword'];
  $strc[]="karyawan.nama_karyawan LIKE '%$keyword%'";
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

$query="SELECT * from slip_gaji 
join karyawan on slip_gaji.id_karyawan=karyawan.id_karyawan
$strw AND tanggal BETWEEN '$tgl_mulai' AND'$tgl_selesai' ";
$result=mysqli_query($koneksi,$query);
$resnum=mysqli_num_rows($result);                     
?>


<h4>SLIP GAJI</h4>
<div>
<form action="index.php?halaman=slip_gaji" method="post" class="form">
    <br/>
  <div class="row">
    <div class="search-bar">
      <input type="text" name="keyword" placeholder="Cari Nama Karyawan" title="Masukkan keyword pencarian" autocomplete="off">
    </div>
  </div>
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
      <div class="form-group">
         <input type="submit" class="btn btn-primary mb-4" name="submit" value="Search">
      </div>
      </div>
      <div class="col-md-2">
                    <a href="index.php?halaman=tambah_slip_gaji" class="btn btn-info">Tambah Data</a>
      </div>

  </div>

    </div>
              </form>
  
              <!-- Hoverable Table rows -->
              <div class="card">
                <h5 class="card-header">Slip Gaji</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>ID Slip Gaji</th>
                        <th>Nama Karyawan</th>
                        <th>Tanggal</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php $no=1; ?>
                        <?php while($pecah = $result->fetch_assoc()){?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $pecah['id_slip_gaji']; ?></td>
                          <td><?php echo $pecah['nama_karyawan']; ?></td>
                          <td><?php echo date("d F Y",strtotime($pecah["tanggal"])); ?></td>
                    <td class='action'>
                    <center><a href="index.php?halaman=detail_slip_gaji&id_slip_gaji=<?php echo $pecah["id_slip_gaji"]; ?>" class="btn btn-info">Slip Gaji</a>
                      
                          </td>
                        </tr>
                        <?php $no++; ?>
                        <?php } ?>
                    </tbody>
                  </table>
                  
                </div>
              </div>
</div>