<h4><span class="text-muted fw-light"> Data Status |</span> Status Potongan</h4>
<div class="card">
    <form method="post">
        <h5 class="card-header">Tambah Data</h5>
        <div class="card-header">
            <div>
                <label for="defaultFormControlInput" class="form-label">ID Status Potongan</label>
                <input
                type="text"
                class="form-control"
                name="id_status"
                placeholder="isi id status"
                aria-describedby="defaultFormControlHelp" />
            </div>
            <div>
                <label for="defaultFormControlInput" class="form-label">Nama Status</label>
                <input
                type="text"                                    
                class="form-control"
                name="nama_status"
                placeholder="isi nama status"
                aria-describedby="defaultFormControlHelp" />
            </div>

        </div>
        <div class="card-header">
            <button class="btn btn-primary" name="save">Simpan</button>
            <a href="index.php?halaman=status_potongan" class="btn btn-secondary"> Kembali </a>
        </div>
    </form>
</div>

<?php
    if(isset($_POST["save"]))
    {
        $sql=$koneksi->query("INSERT INTO status_potongan(id_status,nama_status) VALUES('$_POST[id_status]','$_POST[nama_status]')");
        if($sql)
        {
            echo "<script>alert('Data berhasil ditambahkan'); window.location = 'index.php?halaman=status_potongan'</script>";
        }
        else
        {
            echo "<script>alert('Proses gagal'); window.location = 'index.php?halaman=tambah_status_potongan'</script>";
        }
    }
?>
</div>