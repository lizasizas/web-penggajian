<h4><span class="text-muted fw-light"> Data Potongan |</span> Jenis Potongan</h4>
<div class="card">
    <form method="post">
        <h5 class="card-header">Tambah Data</h5>
        <div class="card-header">
            <div>
                <label for="defaultFormControlInput" class="form-label">ID Potongan</label>
                <input
                type="text"
                class="form-control"
                name="id_potongan"
                placeholder="isi id potongan"
                aria-describedby="defaultFormControlHelp" />
            </div>
            <div>
                <label for="defaultFormControlInput" class="form-label">Nama Potongan</label>
                <input
                type="text"                                    
                class="form-control"
                name="nama_potongan"
                placeholder="isi nama Potongan"
                aria-describedby="defaultFormControlHelp" />
            </div>
            <div>
                <label for="defaultFormControlInput" class="form-label">Besar Potongan</label>
                <input
                type="text"                                    
                class="form-control"
                name="besar_potongan"
                placeholder="isi besar potongan"
                aria-describedby="defaultFormControlHelp" />
            </div>

        </div>
        <div class="card-header">
            <button class="btn btn-primary" name="save">Simpan</button>
            <a href="index.php?halaman=potongan" class="btn btn-secondary"> Kembali </a>
        </div>
    </form>
</div>

<?php
    if(isset($_POST["save"]))
    {
        $sql=$koneksi->query("INSERT INTO daftar_tunjangan(id_daftar_tunjangan,id_karyawan) VALUES('$_POST[id_daftar_tunjangan]','$_POST[nama_potongan]','$_POST[besar_potongan]')");
        if($sql)
        {
            echo "<script>alert('Data berhasil ditambahkan'); window.location = 'index.php?halaman=potongan'</script>";
        }
        else
        {
            echo "<script>alert('Proses gagal'); window.location = 'index.php?halaman=tambah_potongan'</script>";
        }
    }
?>
</div>