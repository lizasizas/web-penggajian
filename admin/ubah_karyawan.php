<?php           
                $id_karyawan=isset($_GET['id_karyawan']) ? $_GET['id_karyawan']:'';
                $sql="SELECT * FROM karyawan WHERE id_karyawan='$id_karyawan'";
                $hasil=mysqli_query($koneksi, $sql);
                while($data= mysqli_fetch_array($hasil)){
                echo
                "<div class='card'>
                    <form method='post'>
                        <h5 class='card-header'>Ubah Data</h5>
                        <div class='card-header'>
                                <div>
                                <label for='defaultFormControlInput' class='form-label'>ID karyawan</label>
                                <input
                                type='text'
                                class='form-control'
                                name='id_karyawan'
                                placeholder='isi id karyawan'
                                aria-describedby='defaultFormControlHelp'
                                value='".$data['id_karyawan']."' />
                            </div>
                            <div>
                                <label for='defaultFormControlInput' class='form-label'>Nama karyawan</label>
                                <input
                                type='text'                                    
                                class='form-control'
                                name='nama_karyawan'
                                placeholder='isi nama karyawan'
                                aria-describedby='defaultFormControlHelp' 
                                value='".$data['nama_karyawan']."'/>
                            </div>
                            <div>
                                <label for='defaultFormControlInput' class='form-label'>No Rekening</label>
                                <input
                                type='text'                                    
                                class='form-control'
                                name='no_rekening'
                                placeholder='isi no rekening'
                                aria-describedby='defaultFormControlHelp' 
                                value='".$data['no_rekening']."'/>
                            </div>
                            <div>
                                <label class='control-label'> Jabatan </label>
                                    <div class='controls'>
                                    <select class='form-control' name='id_jabatan' required>
                                        <option value=''>Pilih jabatan</option>";
                                            $sql2="SELECT * FROM jabatan";
                                            $hasil2=mysqli_query($koneksi, $sql2);
                                        if (mysqli_num_rows($hasil2) > 0) {
                                            while ($data2= mysqli_fetch_array($hasil2)){
                                            echo"
                                            <option value='".$data2['id_jabatan']."'>";
                                            echo $data2['nama_jabatan']; "</option>";
                                            } } 
                                            echo"
                                    </select>
                                    </div>
                            </div>
                            <div>
                                <label class='control-label'> Golongan </label>
                                    <div class='controls'>
                                    <select class='form-control' name='id_golongan' required>
                                        <option value=''>Pilih Golongan</option>";
                                            $sql2="SELECT * FROM golongan";
                                            $hasil2=mysqli_query($koneksi, $sql2);
                                        if (mysqli_num_rows($hasil2) > 0) {
                                            while ($data2= mysqli_fetch_array($hasil2)){
                                            echo"
                                            <option value='".$data2['id_golongan']."'>";
                                            echo $data2['nama_golongan']; "</option>";
                                            } } 
                                            echo"
                                    </select>
                                    </div>
                            </div>
                            <div>
                                <label class='control-label'> Divisi</label>
                                    <div class='controls'>
                                    <select class='form-control' name='id_divisi' required>
                                        <option value=''>Pilih divisi</option>";
                                            $sql2="SELECT * FROM divisi";
                                            $hasil2=mysqli_query($koneksi, $sql2);
                                        if (mysqli_num_rows($hasil2) > 0) {
                                            while ($data2= mysqli_fetch_array($hasil2)){
                                            echo"
                                            <option value='".$data2['id_divisi']."'>";
                                            echo $data2['nama_divisi']; "</option>";
                                            } } 
                                            echo"
                                    </select>
                                    </div>
                            </div>
                            <div>
                                <label class='control-label'> Agama</label>
                                    <div class='controls'>
                                    <select class='form-control' name='id_agama' required>
                                        <option value=''>Pilih agama</option>";
                                            $sql2="SELECT * FROM agama";
                                            $hasil2=mysqli_query($koneksi, $sql2);
                                        if (mysqli_num_rows($hasil2) > 0) {
                                            while ($data2= mysqli_fetch_array($hasil2)){
                                            echo"
                                            <option value='".$data2['id_agama']."'>";
                                            echo $data2['nama_agama']; "</option>";
                                            } } 
                                            echo"
                                    </select>
                                    </div>
                            </div>
                            <div>
                                <label class='control-label'> Status Nikah</label>
                                    <div class='controls'>
                                    <select class='form-control' name='id_status_nikah' required>
                                        <option value=''>Pilih Status Nikah</option>";
                                            $sql2="SELECT * FROM status_nikah";
                                            $hasil2=mysqli_query($koneksi, $sql2);
                                        if (mysqli_num_rows($hasil2) > 0) {
                                            while ($data2= mysqli_fetch_array($hasil2)){
                                            echo"
                                            <option value='".$data2['id_status_nikah']."'>";
                                            echo $data2['nama_status_nikah']; "</option>";
                                            } } 
                                            echo"
                                    </select>
                                    </div>
                            </div>
                            <div>
                                <label for='defaultFormControlInput' class='form-label'>Jumlah Anak</label>
                                <input
                                type='text'                                    
                                class='form-control'
                                name='nama_karyawanjumlah_anak'
                                placeholder='isi jumlah anak'
                                aria-describedby='defaultFormControlHelp' 
                                value='".$data['jumlah_anak']."'/>
                            </div>
                           
                        </div>
                        <div class='card-header'>
                            <button class='btn btn-primary' name='kirim'>Edit</button>
                            <a href='index.php?halaman=karyawan' class='btn btn-secondary'> Kembali </a>
                        </div>
                    </form>
                </div>";
                }
            ?>
      
  <?php
  if(isset($_POST['kirim']))
  {
    $sql=$koneksi->query("UPDATE karyawan SET id_karyawan='$_POST[id_karyawan]',nama_karyawan='$_POST[nama_karyawan]',no_rekening='$_POST[no_rekening]',id_jabatan='$_POST[id_jabatan]' WHERE id_karyawan='$_GET[id_karyawan]'");
    if($sql) 
    {
      echo "<script>alert('Data Berhasil Diubah'); document.location.href='index.php?halaman=karyawan'; </script>";
    } 
    else 
    {
      echo "<script>alert('Proses Gagal'); document.location.href='index.php?halaman=ubah_karyawan'; </script>";
    }
  }
?> 