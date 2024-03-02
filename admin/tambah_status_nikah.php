<h4><span class="text-muted fw-light"> Data Karyawan |</span> Status Nikah</h4>
<div class="card">
    <form method="post">
        <h5 class="card-header">Tambah Data</h5>
        <div class="card-header">
            <div>
                <label for="defaultFormControlInput" class="form-label">ID Status Nikah</label>
                <input
                type="text"
                class="form-control"
                name="id_status_nikah"
                placeholder="isi id status nikah"
                aria-describedby="defaultFormControlHelp" />
            </div>
            <div>
                <label for="defaultFormControlInput" class="form-label">Nama Status Nikah</label>
                <input
                type="text"                                    
                class="form-control"
                name="nama_status_nikah"
                placeholder="isi nama status nikah"
                aria-describedby="defaultFormControlHelp" />
            </div>

        </div>
        <div class="card-header">
            <button class="btn btn-primary" name="save">Simpan</button>
            <a href="index.php?halaman=status_nikah" class="btn btn-secondary"> Kembali </a>
        </div>
    </form>
</div>

<?php
    if(isset($_POST["save"]))
    {
        $sql=$koneksi->query("INSERT INTO status_nikah(id_status_nikah,nama_status_nikah) VALUES('$_POST[id_status_nikah]','$_POST[nama_status_nikah]')");
        if($sql)
        {
            echo "<script>alert('Data berhasil ditambahkan'); window.location = 'index.php?halaman=status_nikah'</script>";
        }
        else
        {
            echo "<script>alert('Proses gagal'); window.location = 'index.php?halaman=tambah_status_nikah'</script>";
        }
    }
?>
</div>