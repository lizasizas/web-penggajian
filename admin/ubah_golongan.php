<?php           
                $id_golongan=isset($_GET['id_golongan']) ? $_GET['id_golongan']:'';
                $sql="SELECT * FROM golongan WHERE id_golongan='$id_golongan'";
                $hasil=mysqli_query($koneksi, $sql);
                while($data= mysqli_fetch_array($hasil)){
                echo
                "<div class='card'>
                    <form method='post'>
                        <h5 class='card-header'>Ubah Data</h5>
                        <div class='card-header'>
                                <div>
                                <label for='defaultFormControlInput' class='form-label'>ID golongan</label>
                                <input
                                type='text'
                                class='form-control'
                                name='id_golongan'
                                placeholder='isi id golongan'
                                aria-describedby='defaultFormControlHelp'
                                value='".$data['id_golongan']."' />
                            </div>
                            <div>
                                <label for='defaultFormControlInput' class='form-label'>Jenis golongan</label>
                                <input
                                type='text'                                    
                                class='form-control'
                                name='nama_golongan'
                                placeholder='isi nama golongan'
                                aria-describedby='defaultFormControlHelp' 
                                value='".$data['nama_golongan']."'/>
                            </div>
                            <div>
                                <label for='defaultFormControlInput' class='form-label'>Gaji Pokok</label>
                                <input
                                type='text'                                    
                                class='form-control'
                                name='gaji_pokok'
                                placeholder='isi besar gaji pokok'
                                aria-describedby='defaultFormControlHelp' 
                                value='".$data['gaji_pokok']."'/>
                            </div>
                            <div>
                                <label for='defaultFormControlInput' class='form-label'>Persen Pajak</label>
                                <input
                                type='text'                                    
                                class='form-control'
                                name='persen_pajak'
                                placeholder='isi besar persen pajak'
                                aria-describedby='defaultFormControlHelp' 
                                value='".$data['persen_pajak']."'/>
                            </div>
                            
                        </div>
                        <div class='card-header'>
                            <button class='btn btn-primary' name='kirim'>Edit</button>
                            <a href='index.php?halaman=golongan' class='btn btn-secondary'> Kembali </a>
                        </div>
                    </form>
                </div>";
                }
            ?>
      
  <?php
  if(isset($_POST['kirim']))
  {
    $sql=$koneksi->query("UPDATE golongan SET id_golongan='$_POST[id_golongan]',nama_golongan='$_POST[nama_golongan]',gaji_pokok='$_POST[gaji_pokok]',persen_pajak='$_POST[persen_pajak]' WHERE id_golongan='$_GET[id_golongan]'");
    if($sql) 
    {
      echo "<script>alert('Data Berhasil Diubah'); document.location.href='index.php?halaman=golongan'; </script>";
    } 
    else 
    {
      echo "<script>alert('Proses Gagal'); document.location.href='index.php?halaman=ubah_golongan'; </script>";
    }
  }
?> 