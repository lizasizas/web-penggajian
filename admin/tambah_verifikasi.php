<h4><span class="text-muted fw-light"> Data Karyawan |</span> Verifikasi</h4>
<div class="card">
    <form method="post">
        <h5 class="card-header">Tambah Data</h5>
        <div class="card-header">
            <div>
                <label for="defaultFormControlInput" class="form-label">ID Verifikasi</label>
                <input
                type="text"
                class="form-control"
                name="id_verifikasi"
                placeholder="isi id verifikasi"
                aria-describedby="defaultFormControlHelp" />
            </div>
            <div>
                <label for="defaultFormControlInput" class="form-label">Nama Verifikasi</label>
                <input
                type="text"                                    
                class="form-control"
                name="nama_verifikasi"
                placeholder="isi nama verifikasi"
                aria-describedby="defaultFormControlHelp" />
            </div>

        </div>
        <div class="card-header">
            <button class="btn btn-primary" name="save">Simpan</button>
            <a href="index.php?halaman=verifikasi" class="btn btn-secondary"> Kembali </a>
        </div>
    </form>
</div>

<?php
    if(isset($_POST["save"]))
    {
        $sql=$koneksi->query("INSERT INTO verifikasi(id_verifikasi,nama_verifikasi) VALUES('$_POST[id_verifikasi]','$_POST[nama_verifikasi]')");
        if($sql)
        {
            echo "<script>alert('Data berhasil ditambahkan'); window.location = 'index.php?halaman=verifikasi'</script>";
        }
        else
        {
            echo "<script>alert('Proses gagal'); window.location = 'index.php?halaman=tambah_verifikasi'</script>";
        }
    }
?>
</div>