<?php           
                $id_agama=isset($_GET['id_agama']) ? $_GET['id_agama']:'';
                $sql="SELECT * FROM agama WHERE id_agama='$id_agama'";
                $hasil=mysqli_query($koneksi, $sql);
                while($data= mysqli_fetch_array($hasil)){
                echo
                "<div class='card'>
                    <form method='post'>
                        <h5 class='card-header'>Ubah Data</h5>
                        <div class='card-header'>
                                <div>
                                <label for='defaultFormControlInput' class='form-label'>ID Agama</label>
                                <input
                                type='text'
                                class='form-control'
                                name='id_agama'
                                placeholder='isi id agama'
                                aria-describedby='defaultFormControlHelp'
                                value='".$data['id_agama']."' />
                            </div>
                            <div>
                                <label for='defaultFormControlInput' class='form-label'>Nama Agama</label>
                                <input
                                type='text'                                    
                                class='form-control'
                                name='nama_agama'
                                placeholder='isi nama agama'
                                aria-describedby='defaultFormControlHelp' 
                                value='".$data['nama_agama']."'/>
                            </div>
                           
                        </div>
                        <div class='card-header'>
                            <button class='btn btn-primary' name='kirim'>Edit</button>
                            <a href='index.php?halaman=agama' class='btn btn-secondary'> Kembali </a>
                        </div>
                    </form>
                </div>";
                }
            ?>
      
  <?php
  if(isset($_POST['kirim']))
  {
    $sql=$koneksi->query("UPDATE agama SET id_agama='$_POST[id_agama]',nama_agama='$_POST[nama_agama]' WHERE id_agama='$_GET[id_agama]'");
    if($sql) 
    {
      echo "<script>alert('Data Berhasil Diubah'); document.location.href='index.php?halaman=agama'; </script>";
    } 
    else 
    {
      echo "<script>alert('Proses Gagal'); document.location.href='index.php?halaman=ubah_agama'; </script>";
    }
  }
?> 