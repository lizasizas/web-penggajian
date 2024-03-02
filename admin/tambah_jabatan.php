<h4><span class="text-muted fw-light"> Data jabatan |</span> Jenis jabatan</h4>
<div class="card">
    <form method="post">
        <h5 class="card-header">Tambah Data</h5>
        <div class="card-header">
            <div>
                <label for="defaultFormControlInput" class="form-label">ID jabatan</label>
                <input
                type="text"
                class="form-control"
                name="id_jabatan"
                placeholder="isi id jabatan"
                aria-describedby="defaultFormControlHelp" />
            </div>
            <div>
                <label for="defaultFormControlInput" class="form-label">Nama jabatan</label>
                <input
                type="text"                                    
                class="form-control"
                name="nama_jabatan"
                placeholder="isi nama jabatan"
                aria-describedby="defaultFormControlHelp" />
            </div>
            <div>
                <label for="defaultFormControlInput" class="form-label">Tunjangan jabatan</label>
                <input
                type="text"                                    
                class="form-control"
                name="tunjangan_jabatan"
                placeholder="isi tunjangan jabatan"
                aria-describedby="defaultFormControlHelp" />
            </div>

        </div>
        <div class="card-header">
            <button class="btn btn-primary" name="save">Simpan</button>
            <a href="index.php?halaman=jabatan" class="btn btn-secondary"> Kembali </a>
        </div>
    </form>
</div>

<?php
    if(isset($_POST["save"]))
    {
        $sql=$koneksi->query("INSERT INTO jabatan(id_jabatan,nama_jabatan,tunjangan_jabatan) VALUES('$_POST[id_jabatan]','$_POST[nama_jabatan]','$_POST[tunjangan_jabatan]')");
        if($sql)
        {
            echo "<script>alert('Data berhasil ditambahkan'); window.location = 'index.php?halaman=jabatan'</script>";
        }
        else
        {
            echo "<script>alert('Proses gagal'); window.location = 'index.php?halaman=tambah_jabatan'</script>";
        }
    }
?>
</div>