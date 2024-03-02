<h4><span class="text-muted fw-light"> Data Divisi |</span> Jenis Divisi</h4>
<div class="card">
    <form method="post">
        <h5 class="card-header">Tambah Data</h5>
        <div class="card-header">
            <div>
                <label for="defaultFormControlInput" class="form-label">ID Divisi</label>
                <input
                type="text"
                class="form-control"
                name="id_divisi"
                placeholder="isi id divisi"
                aria-describedby="defaultFormControlHelp" />
            </div>
            <div>
                <label for="defaultFormControlInput" class="form-label">Nama divisi</label>
                <input
                type="text"                                    
                class="form-control"
                name="nama_divisi"
                placeholder="isi nama divisi"
                aria-describedby="defaultFormControlHelp" />
            </div>

        </div>
        <div class="card-header">
            <button class="btn btn-primary" name="save">Simpan</button>
            <a href="index.php?halaman=divisi" class="btn btn-secondary"> Kembali </a>
        </div>
    </form>
</div>

<?php
    if(isset($_POST["save"]))
    {
        $sql=$koneksi->query("INSERT INTO divisi(id_divisi,nama_divisi) VALUES('$_POST[id_divisi]','$_POST[nama_divisi]')");
        if($sql)
        {
            echo "<script>alert('Data berhasil ditambahkan'); window.location = 'index.php?halaman=divisi'</script>";
        }
        else
        {
            echo "<script>alert('Proses gagal'); window.location = 'index.php?halaman=tambah_divisi'</script>";
        }
    }
?>
</div>