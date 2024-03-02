<?php           
                $id_divisi=isset($_GET['id_divisi']) ? $_GET['id_divisi']:'';
                $sql="SELECT * FROM divisi WHERE id_divisi='$id_divisi'";
                $hasil=mysqli_query($koneksi, $sql);
                while($data= mysqli_fetch_array($hasil)){
                echo
                "<div class='card'>
                    <form method='post'>
                        <h5 class='card-header'>Ubah Data</h5>
                        <div class='card-header'>
                                <div>
                                <label for='defaultFormControlInput' class='form-label'>ID Divisi</label>
                                <input
                                type='text'
                                class='form-control'
                                name='id_divisi'
                                placeholder='isi id divisi'
                                aria-describedby='defaultFormControlHelp'
                                value='".$data['id_divisi']."' />
                            </div>
                            <div>
                                <label for='defaultFormControlInput' class='form-label'>Nama Divisi</label>
                                <input
                                type='text'                                    
                                class='form-control'
                                name='nama_divisi'
                                placeholder='isi nama divisi'
                                aria-describedby='defaultFormControlHelp' 
                                value='".$data['nama_divisi']."'/>
                            </div>
                            
                        </div>
                        <div class='card-header'>
                            <button class='btn btn-primary' name='kirim'>Edit</button>
                            <a href='index.php?halaman=divisi' class='btn btn-secondary'> Kembali </a>
                        </div>
                    </form>
                </div>";
                }
            ?>
      
  <?php
  if(isset($_POST['kirim']))
  {
    $sql=$koneksi->query("UPDATE divisi SET id_divisi='$_POST[id_divisi]',nama_divisi='$_POST[nama_divisi]' WHERE id_divisi='$_GET[id_divisi]'");
    if($sql) 
    {
      echo "<script>alert('Data Berhasil Diubah'); document.location.href='index.php?halaman=divisi'; </script>";
    } 
    else 
    {
      echo "<script>alert('Proses Gagal'); document.location.href='index.php?halaman=ubah_divisi'; </script>";
    }
  }
?> 