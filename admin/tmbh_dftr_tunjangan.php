<form method="post" action="">
    <div class="form-check">
    <label>DAFTAR TUNJANGAN </label>
    <?php $ambil=$koneksi->query("SELECT * FROM tunjangan");?>
    <?php while($pecah=$ambil ->fetch_assoc()){ ?>
    
    <input type="checkbox" name="daftar_tunjangan[]" value="<?php echo $pecah['id_tunjangan'];?>" >
    
    <?php }?>
    <div class="card-header">
            <button class="btn btn-primary" type="submit" name="save">Simpan</button>
            <a href="index.php" class="btn btn-secondary"> Kembali </a>
        </div>    
</form>