<?php           
                $id_tunjangan=isset($_GET['id_tunjangan']) ? $_GET['id_tunjangan']:'';
                $sql="SELECT * FROM tunjangan WHERE id_tunjangan='$id_tunjangan'";
                $hasil=mysqli_query($koneksi, $sql);
                while($data= mysqli_fetch_array($hasil)){
                echo
                "<div class='card'>
                    <form method='post'>
                        <h5 class='card-header'>Ubah Data</h5>
                        <div class='card-header'>
                                <div>
                                <label for='defaultFormControlInput' class='form-label'>ID Tunjangan</label>
                                <input
                                type='text'
                                class='form-control'
                                name='id_tunjangan'
                                placeholder='isi id tunjangan'
                                aria-describedby='defaultFormControlHelp'
                                value='".$data['id_tunjangan']."' />
                            </div>
                            <div>
                                <label for='defaultFormControlInput' class='form-label'>Jenis Tunjangan</label>
                                <input
                                type='text'                                    
                                class='form-control'
                                name='nama_tunjangan'
                                placeholder='isi nama tunjangan'
                                aria-describedby='defaultFormControlHelp' 
                                value='".$data['nama_tunjangan']."'/>
                            </div>
                            <div>
                                <label for='defaultFormControlInput' class='form-label'>Besar Tunjangan</label>
                                <input
                                type='text'                                    
                                class='form-control'
                                name='besar_tunjangan'
                                placeholder='isi besar tunjangan'
                                aria-describedby='defaultFormControlHelp' 
                                value='".$data['besar_tunjangan']."'/>
                            </div>
                            
                        </div>
                        <div class='card-header'>
                            <button class='btn btn-primary' name='kirim'>Edit</button>
                            <a href='index.php?halaman=tunjangan' class='btn btn-secondary'> Kembali </a>
                        </div>
                    </form>
                </div>";
                }
            ?>
      
  <?php
  if(isset($_POST['kirim']))
  {
    $sql=$koneksi->query("UPDATE tunjangan SET id_tunjangan='$_POST[id_tunjangan]',nama_tunjangan='$_POST[nama_tunjangan]',besar_tunjangan='$_POST[besar_tunjangan]' WHERE id_tunjangan='$_GET[id_tunjangan]'");
    if($sql) 
    {
      echo "<script>alert('Data Berhasil Diubah'); document.location.href='index.php?halaman=tunjangan'; </script>";
    } 
    else 
    {
      echo "<script>alert('Proses Gagal'); document.location.href='index.php?halaman=ubah_tunjangan'; </script>";
    }
  }
?> 