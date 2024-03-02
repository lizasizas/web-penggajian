<h4><span class="text-muted fw-light"> Data Tunjangan |</span> Jenis tunjangan</h4>
<div class="card">
    <form method="post">
        <h5 class="card-header">Tambah Data</h5>
        <div class="card-header">
            <div>
                <label for="defaultFormControlInput" class="form-label">ID Tunjangan</label>
                <input
                type="text"
                class="form-control"
                name="id_tunjangan"
                placeholder="isi id tunjangan"
                aria-describedby="defaultFormControlHelp" />
            </div>
            <div>
                <label for="defaultFormControlInput" class="form-label">Nama Tunjangan</label>
                <input
                type="text"                                    
                class="form-control"
                name="nama_tunjangan"
                placeholder="isi nama tunjangan"
                aria-describedby="defaultFormControlHelp" />
            </div>
            <div>
                <label for="defaultFormControlInput" class="form-label">Besar Tunjangan</label>
                <input
                type="text"                                    
                class="form-control"
                name="besar_tunjangan"
                placeholder="isi besar tunjangan"
                aria-describedby="defaultFormControlHelp" />
            </div>

        </div>
        <div class="card-header">
            <button class="btn btn-primary" name="save">Simpan</button>
            <a href="index.php?halaman=tunjangan" class="btn btn-secondary"> Kembali </a>
        </div>
    </form>
</div>

<?php
    if(isset($_POST["save"]))
    {
        $sql=$koneksi->query("INSERT INTO tunjangan(id_tunjangan,nama_tunjangan,besar_tunjangan) VALUES('$_POST[id_tunjangan]','$_POST[nama_tunjangan]','$_POST[besar_tunjangan]')");
        if($sql)
        {
            echo "<script>alert('Data berhasil ditambahkan'); window.location = 'index.php?halaman=tunjangan'</script>";
        }
        else
        {
            echo "<script>alert('Proses gagal'); window.location = 'index.php?halaman=tambah_tunjangan'</script>";
        }
    }
?>
</div>