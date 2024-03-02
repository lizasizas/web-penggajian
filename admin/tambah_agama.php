<h4><span class="text-muted fw-light"> Data Karyawan |</span> Agama</h4>
<div class="card">
    <form method="post">
        <h5 class="card-header">Tambah Data</h5>
        <div class="card-header">
            <div>
                <label for="defaultFormControlInput" class="form-label">ID Agama</label>
                <input
                type="text"
                class="form-control"
                name="id_agama"
                placeholder="isi id agama"
                aria-describedby="defaultFormControlHelp" />
            </div>
            <div>
                <label for="defaultFormControlInput" class="form-label">Nama Agama</label>
                <input
                type="text"                                    
                class="form-control"
                name="nama_agama"
                placeholder="isi nama agama"
                aria-describedby="defaultFormControlHelp" />
            </div>

        </div>
        <div class="card-header">
            <button class="btn btn-primary" name="save">Simpan</button>
            <a href="index.php?halaman=agama" class="btn btn-secondary"> Kembali </a>
        </div>
    </form>
</div>

<?php
    if(isset($_POST["save"]))
    {
        $sql=$koneksi->query("INSERT INTO agama(id_agama,nama_agama) VALUES('$_POST[id_agama]','$_POST[nama_agama]')");
        if($sql)
        {
            echo "<script>alert('Data berhasil ditambahkan'); window.location = 'index.php?halaman=agama'</script>";
        }
        else
        {
            echo "<script>alert('Proses gagal'); window.location = 'index.php?halaman=tambah_agama'</script>";
        }
    }
?>
</div>