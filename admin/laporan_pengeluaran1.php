<?php
include 'config.php';
$id_jabatan="";
$id_divisi="";
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
        $tgl_selesai=date("Y-m-d");
    }
    $tgl_mulai=$_POST['tgl_mulai'];
    $strc[]="slip_gaji.tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai' ";
    $jmlh++;
} 
if (isset($_POST['id_jabatan']))
{
    $id_jabatan=$_POST['id_jabatan'];
    $strc[]="karyawan.id_jabatan='$id_jabatan'";
    $jmlh++;
} 
if (isset($_POST['id_golongan']))
{
    $id_golongan=$_POST['id_golongan'];
    $strc[]="karyawan.id_golongan='$id_golongan'";
    $jmlh++;
} 
if (isset($_POST['id_divisi']))
{
    $id_divisi=$_POST['id_divisi'];
    $strc[]="karyawan.id_divisi='$id_divisi'";
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
$query="SELECT * FROM slip_gaji 
JOIN karyawan ON slip_gaji.id_karyawan = karyawan.id_karyawan 
INNER JOIN golongan ON karyawan.id_golongan = golongan.id_golongan
INNER JOIN divisi ON karyawan.id_divisi = divisi.id_divisi
INNER JOIN jabatan ON karyawan.id_jabatan = jabatan.id_jabatan  $strw";
$result=mysqli_query($koneksi,$query);                  
$pecah2=$koneksi->query("SELECT * From golongan");  
$pecah3=$koneksi->query("SELECT * From jabatan");   
$pecah4=$koneksi->query("SELECT * From divisi");                                                                  
?>


<h4><span class="text-muted fw-light"> LAPORAN |</span> PENGELUARAN GAJI KARYAWAN</h4>
<div>
     <form action="index.php?halaman=laporan_pengeluaran1" method="post" class="form">
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
                <label>Jabatan :</label>
                <select class="form-control" name="id_jabatan">
                    <option selected disabled>-- PILIH JABATAN -- </option>
                    <?php while($row = mysqli_fetch_assoc($pecah3)) { ?>
                        <option value="<?php echo $row['id_jabatan']; ?>"> <?php echo $row['nama_jabatan']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
                <div class="col-md-2">
            <div class="form-group">
                <label>Divisi :</label>
                <select class="form-control" name="id_divisi">
                    <option selected disabled>-- PILIH DIVISI -- </option>
                    <?php while($row = mysqli_fetch_assoc($pecah4)) { ?>
                        <option value="<?php echo $row['id_divisi']; ?>"> <?php echo $row['nama_divisi']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
                <div class="col-md-2">
            <div class="form-group">
                <label>Golongan :</label>
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
              </form>
</div>

                <div class="card">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>ID Slip Gaji</th>
                            <th>Nama Karyawan</th>
                            <th>Divisi</th>
                            <th>Jabatan</th>
                            <th>Golongan</th>
                            <th>Tanggal Slip Gaji</th>
                            <th>Gaji Bersih</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        $nomor = 1;

                        while ($pecah = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <td><?php echo $nomor; ?> </td>
                                <td><?php echo $pecah['id_slip_gaji']; ?> </td>
                                <td><?php echo $pecah['nama_karyawan']; ?> </td>
                                <td><?php echo $pecah['nama_divisi']; ?> </td>
                                <td><?php echo $pecah['nama_jabatan']; ?> </td>
                                <td><?php echo $pecah['nama_golongan']; ?> </td>
								<td><?php echo date("d F Y",strtotime($pecah["tanggal"])); ?></td>
                                <td>Rp. <?php echo number_format($pecah['gaji_bersih']); ?></td>
                            </tr>
                            <?php $total += ($pecah['gaji_bersih']); ?>
                            <?php $nomor++; ?>
                        <?php } ?>
                            <tr>
                                <th colspan="7"><center>Total </th>
                                <th>Rp <?php echo number_format($total) ?>
                                </th>
                            </tr>
                    </tbody>
                </table>
</div>
                        </div>