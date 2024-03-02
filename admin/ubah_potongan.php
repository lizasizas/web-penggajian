<?php           
                $id_potongan=isset($_GET['id_potongan']) ? $_GET['id_potongan']:'';
                $sql="SELECT * FROM potongan WHERE id_potongan='$id_potongan'";
                $hasil=mysqli_query($koneksi, $sql);
                while($data= mysqli_fetch_array($hasil)){
                echo
                "<div class='card'>
                    <form method='post'>
                        <h5 class='card-header'>Ubah Data</h5>
                        <div class='card-header'>
                                <div>
                                <label for='defaultFormControlInput' class='form-label'>ID Potongan</label>
                                <input
                                type='text'
                                class='form-control'
                                name='id_potongan'
                                placeholder='isi id potongan'
                                aria-describedby='defaultFormControlHelp'
                                value='".$data['id_potongan']."' />
                            </div>
                            <div>
                                <label for='defaultFormControlInput' class='form-label'>Jenis Potongan</label>
                                <input
                                type='text'                                    
                                class='form-control'
                                name='nama_potongan'
                                placeholder='isi nama potongan'
                                aria-describedby='defaultFormControlHelp' 
                                value='".$data['nama_potongan']."'/>
                            </div>
                            <div>
                                <label for='defaultFormControlInput' class='form-label'>Besar Potongan</label>
                                <input
                                type='text'                                    
                                class='form-control'
                                name='besar_potongan'
                                placeholder='isi besar potongan'
                                aria-describedby='defaultFormControlHelp' 
                                value='".$data['besar_potongan']."'/>
                            </div>
                            
                        </div>
                        <div class='card-header'>
                            <button class='btn btn-primary' name='kirim'>Edit</button>
                            <a href='index.php?halaman=potongan' class='btn btn-secondary'> Kembali </a>
                        </div>
                    </form>
                </div>";
                }
            ?>
      
  <?php
  if(isset($_POST['kirim']))
  {
    $sql=$koneksi->query("UPDATE potongan SET id_potongan='$_POST[id_potongan]',nama_potongan='$_POST[nama_potongan]',besar_potongan='$_POST[besar_potongan]' WHERE id_potongan='$_GET[id_potongan]'");
    if($sql) 
    {
      echo "<script>alert('Data Berhasil Diubah'); document.location.href='index.php?halaman=potongan'; </script>";
    } 
    else 
    {
      echo "<script>alert('Proses Gagal'); document.location.href='index.php?halaman=ubah_potongan'; </script>";
    }
  }
?> 