<h4><span class="text-muted fw-light"> Data Golongan |</span> Jenis golongan</h4>
<div class="card">
    <form method="post">
        <h5 class="card-header">Tambah Data</h5>
        <div class="card-header">
            <div>
                <label for="defaultFormControlInput" class="form-label">ID Golongan</label>
                <input
                type="text"
                class="form-control"
                name="id_golongan"
                placeholder="isi id golongan"
                aria-describedby="defaultFormControlHelp" />
            </div>
            <div>
                <label for="defaultFormControlInput" class="form-label">Nama Golongan</label>
                <input
                type="text"                                    
                class="form-control"
                name="nama_golongan"
                placeholder="isi nama golongan"
                aria-describedby="defaultFormControlHelp" />
            </div>
            <div>
                <label for="defaultFormControlInput" class="form-label">Gaji Pokok</label>
                <input
                type="text"                                    
                class="form-control"
                name="gaji_pokok"
                placeholder="isi besar gaji pokok"
                aria-describedby="defaultFormControlHelp" />
            </div>
            <div>
                <label for="defaultFormControlInput" class="form-label">Persen Pajak</label>
                <input
                type="text"                                    
                class="form-control"
                name="persen_pajak"
                placeholder="isi persen_pajak"
                aria-describedby="defaultFormControlHelp" />
            </div>

        </div>
        <div class="card-header">
            <button class="btn btn-primary" name="save">Simpan</button>
            <a href="index.php?halaman=golongan" class="btn btn-secondary"> Kembali </a>
        </div>
    </form>
</div>

<?php
    if(isset($_POST["save"]))
    {
        $sql=$koneksi->query("INSERT INTO golongan(id_golongan,nama_golongan,gaji_pokok,persen_pajak) VALUES('$_POST[id_golongan]','$_POST[nama_golongan]','$_POST[gaji_pokok]','$_POST[persen_pajak]')");
        if($sql)
        {
            echo "<script>alert('Data berhasil ditambahkan'); window.location = 'index.php?halaman=golongan'</script>";
        }
        else
        {
            echo "<script>alert('Proses gagal'); window.location = 'index.php?halaman=tambah_golongan'</script>";
        }
    }
?>
</div>