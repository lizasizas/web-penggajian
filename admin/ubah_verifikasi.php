<?php           
                $id_verifikasi=isset($_GET['id_verifikasi']) ? $_GET['id_verifikasi']:'';
                $sql="SELECT * FROM verifikasi WHERE id_verifikasi='$id_verifikasi'";
                $hasil=mysqli_query($koneksi, $sql);
                while($data= mysqli_fetch_array($hasil)){
                echo
                "<div class='card'>
                    <form method='post'>
                        <h5 class='card-header'>Ubah Data</h5>
                        <div class='card-header'>
                                <div>
                                <label for='defaultFormControlInput' class='form-label'>ID Verifikasi</label>
                                <input
                                type='text'
                                class='form-control'
                                name='id_verifikasi'
                                placeholder='isi id verifikasi'
                                aria-describedby='defaultFormControlHelp'
                                value='".$data['id_verifikasi']."' />
                            </div>
                            <div>
                                <label for='defaultFormControlInput' class='form-label'>Nama Verifikasi</label>
                                <input
                                type='text'                                    
                                class='form-control'
                                name='nama_verifikasi'
                                placeholder='isi nama verifikasi'
                                aria-describedby='defaultFormControlHelp' 
                                value='".$data['nama_verifikasi']."'/>
                            </div>
                           
                        </div>
                        <div class='card-header'>
                            <button class='btn btn-primary' name='kirim'>Edit</button>
                            <a href='index.php?halaman=verifikasi' class='btn btn-secondary'> Kembali </a>
                        </div>
                    </form>
                </div>";
                }
            ?>
      
  <?php
  if(isset($_POST['kirim']))
  {
    $sql=$koneksi->query("UPDATE verifikasi SET id_verifikasi='$_POST[id_verifikasi]',nama_verifikasi='$_POST[nama_verifikasi]' WHERE id_verifikasi='$_GET[id_verifikasi]'");
    if($sql) 
    {
      echo "<script>alert('Data Berhasil Diubah'); document.location.href='index.php?halaman=verifikasi'; </script>";
    } 
    else 
    {
      echo "<script>alert('Proses Gagal'); document.location.href='index.php?halaman=ubah_verifikasi'; </script>";
    }
  }
?> 