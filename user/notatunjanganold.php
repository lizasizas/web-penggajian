<?php $koneksi=new mysqli("localhost","root","","u_wages");
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title> nota </title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<BODY STYLE="BACKGROUND-IMAGE:URL(nota.PNG)">



<?php include'header.php'?>

<section class="notatunjangan">
    <div class="container">
    </br>
    </br>
      <center><h3> Nota tunjangan </h3></center>
</br>

<div class="container">
        <div class="row">
            <?php $totaljabatan=0;?>
            <?php $totaldivisi=0;?>
            <?php $totalgolongan=0;?>
            <?php $totaltransaksitunjangan=0;?>
            <?php
                    $id_nota_tunjangan= $_SESSION["karyawan"]['id_karyawan'];
                    $ambil = $koneksi->query("SELECT * FROM karyawan
                     JOIN jabatan ON karyawan.id_jabatan=jabatan.id_jabatan
                     JOIN divisi ON karyawan.id_divisi=divisi.id_divisi
                     JOIN golongan ON karyawan.id_golongan=golongan.id_golongan
                     WHERE id_karyawan = '$id_nota_tunjangan'");
                     while($p=$ambil->fetch_assoc()){  
            ?>
            <table class=" table">
                <tbody>
                <tr><td>Nama Karyawan    : <?php echo $p['nama_karyawan'];?></td></tr>
                <tr><td>Jabatan    : <?php echo $p['nama_jabatan'];?></td></tr>
                <tr><td>Divisi    : <?php echo $p['nama_divisi'];?></td></tr>
                <tr><td>Golongan    : <?php echo $p['nama_golongan'];?></td></tr>
            </table>
            <?php } ?>




<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-13">
                <div class="card">
                    
                    <div class="card-body" style="overflow:auto">
                        <?php
                            include("config.php");
                            $id_karyawan = $_SESSION["karyawan"]["id_karyawan"];
                            $q1 = mysqli_query($koneksi, "SELECT * FROM karyawan
                                JOIN nota_tunjangan ON nota_tunjangan.id_karyawan = karyawan.id_karyawan
                                JOIN divisi ON divisi.id_divisi = karyawan.id_divisi
                                JOIN jabatan ON jabatan.id_jabatan = karyawan.id_jabatan
                                JOIN golongan ON golongan.id_golongan = karyawan.id_golongan
                                WHERE karyawan.id_karyawan = '$id_karyawan'");
                            $qdata = mysqli_fetch_array($q1);
                        ?>

                    </div>
                    <div class="card-body" style="overflow:auto">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">No.</th>
                                    <th width="15%">Jenis tunjangan</th>
                                    <th width="10%">Keterangan</th>
                                    <th width="10%">Status Verifikasi</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 0;
                                    $q2 = mysqli_query($koneksi, "SELECT *
                                        FROM transaksi_tunjangan
                                        INNER JOIN tunjangan ON transaksi_tunjangan.id_tunjangan = tunjangan.id_tunjangan
                                        INNER JOIN nota_tunjangan ON transaksi_tunjangan.id_nota_tunjangan = nota_tunjangan.id_nota_tunjangan
                                        JOIN karyawan ON nota_tunjangan.id_karyawan =karyawan.id_karyawan
                                        JOIN verifikasi ON nota_tunjangan.id_verifikasi = verifikasi.id_verifikasi
                                        WHERE karyawan.id_karyawan = '$id_nota_tunjangan'");
                                    while ($nom = mysqli_fetch_array($q2)){
                                        $no++
                                ?>
                                <!--Tabel form ubah-->
                                <?php echo "<tr id='change_form".$no."' style='display:none'>"; ?>
                                    <form method="post" enctype="multipart/form-data">
                                        <td align=center> <?php echo $no;?></td>
                                        <td>
                                            <select class='form-control' name='tunjangan'>
                                                <?php
                                                    $query3 = mysqli_query($koneksi, "SELECT * FROM tunjangan");
                                                    while ($noa = mysqli_fetch_array($query3)){
                                                ?>
                                                        <?php if($nom['id_tunjangan'] == $noa['id_tunjangan']){
                                                        ?>
                                                            <option value=<?php echo $noa['id_tunjangan'] ?> selected><?php echo $noa['nama_tunjangan'] ?></option>
                                                        <?php } else{
                                                        ?>
                                                            <option value=<?php echo $noa['id_tunjangan'] ?>><?php echo $noa['nama_tunjangan'] ?></option>
                                                        <?php }?>
                                                    <?php }?>
                                            </select>
                                        </td>
                                        <td> <?php echo "<input type='text' class='form-control' placeholder='Keterangan Tunjangan' name='keterangan_tunjangan' value='".$nom['keterangan_tunjangan']."'>"; ?></td>
                                        
                                        <td align=center>
                                            <?php echo "<button type='button' style='width:45%' class='btn btn-secondary' onclick='change(0, ".$no.")'>Batal</button>" ?>
                                            <?php echo "<button type='submit' style='width:45%' name='update".$nom['id_nota_tunjangan']."&".$nom['id_tunjangan']."' class='btn btn-sa'>Simpan</button>"; ?>
                                        </td>
                                    </form>
                                    <?php
                                        $ch = "update".$nom['id_nota_tunjangan']."&".$nom['id_tunjangan'];
                                        if (isset($_POST[$ch])){
                                            $sql=$koneksi->query("UPDATE transaksi_tunjangan
                                                SET id_tunjangan = '$_POST[tunjangan]', keterangan_tunjangan = '$_POST[keterangan_tunjangan]'
                                                WHERE id_nota_tunjangan = '$_GET[id_nota_tunjangan]' AND id_tunjangan = '$nom[id_tunjangan]'
                                            ");
                                            if($sql){
                                                echo "<script>window.location = 'index.php?halaman=hasil&id_nota_tunjangan=".$_GET['id_nota_tunjangan']."'</script>";
                                            }else{
                                                echo "<script>alert('Proses gagal'); window.location = 'index.php?halaman=hasil_pemeriksaaan'</script>";
                                            }
                                        }
                                    ?>
                                </tr>
                                <tr></tr>
                                <!--Tabel normal-->
                                <?php echo "<tr id='normal".$no."'>"; ?>
                                    <td align=center> <?php echo $no;?></td>
                                    <td> <?php echo $nom['nama_tunjangan'];?></td>
                                    <td> <?php echo $nom['keterangan_tunjangan'];?></td>
                                    <td> <?php echo $nom['nama_verifikasi'];?></td>
                                    
                                    
                                            <td align=center>
                                                <?php echo "<button type='button' style='width:45%' class='btn btn-del' onclick='del(1, ".$no.")'>Hapus</button>"; ?>
                                                <?php echo "<button type='button' style='width:45%' class='btn btn-cha' onclick='change(1, ".$no.")'>Ubah</button>"; ?>
                                            </td>

                                <tr></tr>
                                        <?php echo "<tr id='delete".$no."' style='display: none;'>"; ?>
                                            <td colspan=5 align=center>
                                                <p style="color:red"><b>Anda yakin ingin menghapus data tersebut?</b></p>
                                                <?php echo "<button type='button' style='width:45%' class='btn btn-secondary' onclick='del(0, ".$no.")'>Batal</button>" ?>
                                                <?php echo "<a class='btn btn-del' style='width: 45%' href='hapus_transaksi_tunjangan.php?idc=".$nom['id_nota_tunjangan']."&idj=".$nom['id_tunjangan']."&type=hasil'>Ya</a>"; ?>
                                            </td>
                                        </tr>

                                </tr>
                                <?php }?>
                                <!--Form Tambah Data-->
             
                                        <tr id="add_button">
                                            <td colspan=8 align=center><button type="button" class="btn btn-add" onclick="add(1)">Tambah Pengajuan</button></td>
                                        </tr>
                                        <tr></tr>
                                        <tr id="add_form" style="display: none">
                                            <form method="post" enctype="multipart/form-data">
                                                <td align=center> <?php echo $no+1 ?></td>
                                                <td>
                                                    <select class="form-control" name="tunjangan">
                                                        <?php
                                                        $no = 0;
                                                        $query5 = mysqli_query($koneksi, "SELECT * FROM tunjangan");
                                                        while ($noy = mysqli_fetch_array($query5)){
                                                        ?>
                                                        <option value=<?php echo $noy['id_tunjangan']?>> <?php echo $noy['nama_tunjangan'];?> </option>
                                                        <?php }?>
                                                    </select>
                                                </td>
                                                <td><input type="text" class="form-control" placeholder="Keterangan Bank" name="keterangan_tunjangan"></td>
                                               
                                                
                                                <td align=center>
                                                    <button type="button" style="width:45%" class="btn btn-secondary" onclick="add(0)">Batal</button>
                                                    <button type="submit" style="width:45%" name="insert" class="btn btn-sa">Simpan</button>
                                                </td>
                                            </form>
                                            <?php 
                                                if (isset($_POST['insert'])){
                                                    $verif="IDV02";
                                                    $sql=$koneksi->query("INSERT INTO transaksi_tunjangan(id_nota_tunjangan, id_tunjangan, keterangan_tunjangan,id_verifikasi) 
                                                        VALUES('$qdata[id_nota_tunjangan]', '$_POST[tunjangan]', '$_POST[keterangan_tunjangan]','$verif')
                                                    ");
                                                    $ttl = mysqli_query($koneksi, "SELECT COUNT(id_tunjangan) AS t
                                                        FROM transaksi_tunjangan
                                                        WHERE id_nota_tunjangan = '$qdata[id_nota_tunjangan]'");
                                                    $sss = mysqli_fetch_array($ttl)['t']++;
        
                                                    if($sql){
                                                        echo "<script>window.location = 'notatunjangan.php'</script>";
                                                    }else{
                                                        echo "<script>alert('Proses gagal'); window.location = 'index.php?halaman=nota_tunjangan'</script>";
                                                    }
                                                }
                                            ?>
                                        </tr>
                                 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function searchu(){
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("se");
        filter = input.value.toUpperCase();
        table = document.getElementById("example1");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++){
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1){
                    tr[i].style.display = "";
                } else{
                    tr[i].style.display = "none";
                }
            }
            if(i%3 != 0){
                tr[i].style.display = "none";
            }
        }
    }

    function search(){
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("se");
        filter = input.value.toUpperCase();
        table = document.getElementById("example1");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++){
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1){
                    tr[i].style.display = "";
                } else{
                    tr[i].style.display = "none";
                }
            }
            if(i%5 != 3 && i != 0 && i != tr.length-3){
                tr[i].style.display = "none";
            }
            document.getElementById("add_form").style.display = "none";
        }
    }

    function add(sta){
        if(sta == 1){
            document.getElementById("add_button").style.display = "none";
            document.getElementById("add_form").style.display = "";
        } else if(sta == 0){
            document.getElementById("add_button").style.display = "";
            document.getElementById("add_form").style.display = "none";
        }
    }

    function change(stt, row){
        let norm = "normal".concat(row);
        let cfo = "change_form".concat(row);
        if(stt == 1){
            document.getElementById(norm).style.display = "none";
            document.getElementById(cfo).style.display = "";
        } else if(stt == 0){
            document.getElementById(norm).style.display = "";
            document.getElementById(cfo).style.display = "none";
        }
    }

    function del(sts, row){
        let dlt = "delete".concat(row);
        if(sts == 1){
            document.getElementById(dlt).style.display = "";
        } else if(sts == 0){
            document.getElementById(dlt).style.display = "none";
        }
    }
</script>




        <div class='form-actions'>
          <button  onclick="window.print()"  class="btn btn-success"><i class="fa fa-print"></i> Cetak</button>
          
        </div>
               
    
    
    
    
    </div>
</section>


</body>
</html>