<h4><span class="text-muted fw-light"> Data Karyawan |</span> Karyawan</h4>
<div class="card">
    <form method="post">
        <h5 class="card-header">Tambah Data</h5>
        <div class="card-header">
            <div>
                    <?php
                    $ambil1 ="SELECT MAX(id_karyawan) AS max_idt FROM karyawan";
                    $auto = mysqli_query($koneksi, $ambil1);
                    $data = mysqli_fetch_array($auto);
                    $code = $data['max_idt'];
                    if($code) {
                        $urutan = (int)substr($code, 3);
                        $urutan++;
                    } else {
                        $urutan = 1;
                    }
                    $huruf = "IDK";
                    $kd_idk = $huruf . sprintf("%03s", $urutan);
                    
                    ?>
                <label for="defaultFormControlInput" class="form-label">ID karyawan</label>
                <input
                type="text"
                class="form-control"
                value="<?php echo $kd_idk?>"
                name="id_karyawan"
                readonly
                aria-describedby="defaultFormControlHelp" />
            </div>
            <div>
                <label for="defaultFormControlInput" class="form-label">Nama karyawan</label>
                <input
                type="text"                                    
                class="form-control"
                name="nama_karyawan"
                placeholder="isi nama karyawan"
                aria-describedby="defaultFormControlHelp" />
            </div>
            <div>
                <label for="defaultFormControlInput" class="form-label">No Rekening</label>
                <input
                type="text"                                    
                class="form-control"
                name="no_rekening"
                placeholder="isi no rekening"
                aria-describedby="defaultFormControlHelp" />
            </div>
            <div>
                <label class="control-label"> Jabatan </label>
                <div class="controls">
                    <select class="form-control" name="id_jabatan" required>
                        <option value=""> Pilih Jabatan </option>
                        <?php $ambil="SELECT * FROM jabatan";
                        $hasil=mysqli_query($koneksi, $ambil);
                        if (mysqli_num_rows($hasil) > 0) {
                        while ($pecah = mysqli_fetch_array($hasil)){?>
                        <option value="<?php echo $pecah['id_jabatan'];?>">
                        <?php echo $pecah['nama_jabatan'];?></option>
                        <?php } } ?>
                    </select>
                </div>
            </div>
            <div>
                <label class="control-label"> Golongan </label>
                <div class="controls">
                    <select class="form-control" name="id_golongan" required>
                        <option value=""> Pilih golongan </option>
                        <?php $ambil="SELECT * FROM golongan";
                        $hasil=mysqli_query($koneksi, $ambil);
                        if (mysqli_num_rows($hasil) > 0) {
                        while ($pecah = mysqli_fetch_array($hasil)){?>
                        <option value="<?php echo $pecah['id_golongan'];?>">
                        <?php echo $pecah['nama_golongan'];?></option>
                        <?php } } ?>
                    </select>
                </div>
            </div>
            <div>
                <label class="control-label"> divisi </label>
                <div class="controls">
                    <select class="form-control" name="id_divisi" required>
                        <option value=""> Pilih divisi </option>
                        <?php $ambil="SELECT * FROM divisi";
                        $hasil=mysqli_query($koneksi, $ambil);
                        if (mysqli_num_rows($hasil) > 0) {
                        while ($pecah = mysqli_fetch_array($hasil)){?>
                        <option value="<?php echo $pecah['id_divisi'];?>">
                        <?php echo $pecah['nama_divisi'];?></option>
                        <?php } } ?>
                    </select>
                </div>
            </div>
            <div>
                <label class="control-label"> Agama </label>
                <div class="controls">
                    <select class="form-control" name="id_agama" required>
                        <option value=""> Pilih agama </option>
                        <?php $ambil="SELECT * FROM agama";
                        $hasil=mysqli_query($koneksi, $ambil);
                        if (mysqli_num_rows($hasil) > 0) {
                        while ($pecah = mysqli_fetch_array($hasil)){?>
                        <option value="<?php echo $pecah['id_agama'];?>">
                        <?php echo $pecah['nama_agama'];?></option>
                        <?php } } ?>
                    </select>
                </div>
            </div>
            <div>
                <label class="control-label"> Status Nikah </label>
                <div class="controls">
                    <select class="form-control" name="id_status_nikah" required>
                        <option value=""> Status Nikah </option>
                        <?php $ambil="SELECT * FROM status_nikah";
                        $hasil=mysqli_query($koneksi, $ambil);
                        if (mysqli_num_rows($hasil) > 0) {
                        while ($pecah = mysqli_fetch_array($hasil)){?>
                        <option value="<?php echo $pecah['id_status_nikah'];?>">
                        <?php echo $pecah['nama_status_nikah'];?></option>
                        <?php } } ?>
                    </select>
                </div>
            </div>
            <div>
                <label for="defaultFormControlInput" class="form-label">Jumlah Anak</label>
                <input
                type="text"                                    
                class="form-control"
                name="jumlah_anak"
                placeholder="isi jumlah anak"
                aria-describedby="defaultFormControlHelp" />
            </div>
            


        <div class="card-header">
            <button class="btn btn-primary" name="save">Simpan</button>
            <a href="index.php?halaman=karyawan" class="btn btn-secondary"> Kembali </a>
        </div>
    </form>
</div>

<?php
    if(isset($_POST["save"]))
    {
        $sql=$koneksi->query("INSERT INTO karyawan(id_karyawan,nama_karyawan,no_rekening,id_jabatan,id_golongan,id_divisi,id_agama,id_status_nikah,jumlah_anak) 
        VALUES('$_POST[id_karyawan]','$_POST[nama_karyawan]','$_POST[no_rekening]','$_POST[id_jabatan]','$_POST[id_golongan]','$_POST[id_divisi]','$_POST[id_agama]','$_POST[id_status_nikah]','$_POST[jumlah_anak]')");
        if($sql)
        {
            echo "<script>alert('Data berhasil ditambahkan'); window.location = 'index.php?halaman=karyawan'</script>";
        }
        else
        {
            echo "<script>alert('Proses gagal'); window.location = 'index.php?halaman=tambah_karyawan'</script>";
        }
    }
?>
</div>