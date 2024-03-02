<?php           
                $id_jabatan=isset($_GET['id_jabatan']) ? $_GET['id_jabatan']:'';
                $sql="SELECT * FROM jabatan WHERE id_jabatan='$id_jabatan'";
                $hasil=mysqli_query($koneksi, $sql);
                while($data= mysqli_fetch_array($hasil)){
                echo
                "<div class='card'>
                    <form method='post'>
                        <h5 class='card-header'>Ubah Data</h5>
                        <div class='card-header'>
                                <div>
                                <label for='defaultFormControlInput' class='form-label'>ID Jabatan</label>
                                <input
                                type='text'
                                class='form-control'
                                name='id_jabatan'
                                placeholder='isi id jabatan'
                                aria-describedby='defaultFormControlHelp'
                                value='".$data['id_jabatan']."' />
                            </div>
                            <div>
                                <label for='defaultFormControlInput' class='form-label'>Nama Jabatan</label>
                                <input
                                type='text'                                    
                                class='form-control'
                                name='nama_jabatan'
                                placeholder='isi nama jabatan'
                                aria-describedby='defaultFormControlHelp' 
                                value='".$data['nama_jabatan']."'/>
                            </div>
                            <div>
                                <label for='defaultFormControlInput' class='form-label'>Tunjangan Jabatan</label>
                                <input
                                type='text'                                    
                                class='form-control'
                                name='tunjangan_jabatan'
                                placeholder='isi tunjangan jabatan'
                                aria-describedby='defaultFormControlHelp' 
                                value='".$data['tunjangan_jabatan']."'/>
                            </div>
                            
                        </div>
                        <div class='card-header'>
                            <button class='btn btn-primary' name='kirim'>Edit</button>
                            <a href='index.php?halaman=jabatan' class='btn btn-secondary'> Kembali </a>
                        </div>
                    </form>
                </div>";
                }
            ?>
      
  <?php
  if(isset($_POST['kirim']))
  {
    $sql=$koneksi->query("UPDATE jabatan SET id_jabatan='$_POST[id_jabatan]',nama_jabatan='$_POST[nama_jabatan]',tunjangan_jabatan='$_POST[tunjangan_jabatan]' WHERE id_jabatan='$_GET[id_jabatan]'");
    if($sql) 
    {
      echo "<script>alert('Data Berhasil Diubah'); document.location.href='index.php?halaman=jabatan'; </script>";
    } 
    else 
    {
      echo "<script>alert('Proses Gagal'); document.location.href='index.php?halaman=ubah_jabatan'; </script>";
    }
  }
?> 