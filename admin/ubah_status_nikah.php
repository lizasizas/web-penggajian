<?php           
                $id_status_nikah=isset($_GET['id_status_nikah']) ? $_GET['id_status_nikah']:'';
                $sql="SELECT * FROM status_nikah WHERE id_status_nikah='$id_status_nikah'";
                $hasil=mysqli_query($koneksi, $sql);
                while($data= mysqli_fetch_array($hasil)){
                echo
                "<div class='card'>
                    <form method='post'>
                        <h5 class='card-header'>Ubah Data</h5>
                        <div class='card-header'>
                                <div>
                                <label for='defaultFormControlInput' class='form-label'>ID Status Nikah</label>
                                <input
                                type='text'
                                class='form-control'
                                name='id_status_nikah'
                                placeholder='isi id statusnikah'
                                aria-describedby='defaultFormControlHelp'
                                value='".$data['id_status_nikah']."' />
                            </div>
                            <div>
                                <label for='defaultFormControlInput' class='form-label'>Nama Status Nikah</label>
                                <input
                                type='text'                                    
                                class='form-control'
                                name='nama_status_nikah'
                                placeholder='isi nama status nikah'
                                aria-describedby='defaultFormControlHelp' 
                                value='".$data['nama_status_nikah']."'/>
                            </div>
                           
                        </div>
                        <div class='card-header'>
                            <button class='btn btn-primary' name='kirim'>Edit</button>
                            <a href='index.php?halaman=status_nikah' class='btn btn-secondary'> Kembali </a>
                        </div>
                    </form>
                </div>";
                }
            ?>
      
  <?php
  if(isset($_POST['kirim']))
  {
    $sql=$koneksi->query("UPDATE status_nikah SET id_status_nikah='$_POST[id_status_nikah]',nama_status_nikah='$_POST[nama_status_nikah]' WHERE id_status_nikah='$_GET[id_status_nikah]'");
    if($sql) 
    {
      echo "<script>alert('Data Berhasil Diubah'); document.location.href='index.php?halaman=status_nikah'; </script>";
    } 
    else 
    {
      echo "<script>alert('Proses Gagal'); document.location.href='index.php?halaman=ubah_status_nikah'; </script>";
    }
  }
?> 