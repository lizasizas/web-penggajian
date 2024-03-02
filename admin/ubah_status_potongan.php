<?php           
                $id_status=isset($_GET['id_status']) ? $_GET['id_status']:'';
                $sql="SELECT * FROM status_potongan WHERE id_status='$id_status'";
                $hasil=mysqli_query($koneksi, $sql);
                while($data= mysqli_fetch_array($hasil)){
                echo
                "<div class='card'>
                    <form method='post'>
                        <h5 class='card-header'>Ubah Data</h5>
                        <div class='card-header'>
                                <div>
                                <label for='defaultFormControlInput' class='form-label'>ID status</label>
                                <input
                                type='text'
                                class='form-control'
                                name='id_status'
                                placeholder='isi id status'
                                aria-describedby='defaultFormControlHelp'
                                value='".$data['id_status']."' />
                            </div>
                            <div>
                                <label for='defaultFormControlInput' class='form-label'>Nama status</label>
                                <input
                                type='text'                                    
                                class='form-control'
                                name='nama_status'
                                placeholder='isi nama status'
                                aria-describedby='defaultFormControlHelp' 
                                value='".$data['nama_status']."'/>
                            </div>
                           
                        </div>
                        <div class='card-header'>
                            <button class='btn btn-primary' name='kirim'>Edit</button>
                            <a href='index.php?halaman=status_potongan' class='btn btn-secondary'> Kembali </a>
                        </div>
                    </form>
                </div>";
                }
            ?>
      
  <?php
  if(isset($_POST['kirim']))
  {
    $sql=$koneksi->query("UPDATE status_potongan SET id_status='$_POST[id_status]',nama_status='$_POST[nama_status]' WHERE id_status='$_GET[id_status]'");
    if($sql) 
    {
      echo "<script>alert('Data Berhasil Diubah'); document.location.href='index.php?halaman=status_potongan'; </script>";
    } 
    else 
    {
      echo "<script>alert('Proses Gagal'); document.location.href='index.php?halaman=ubah_status_potongan'; </script>";
    }
  }
?> 