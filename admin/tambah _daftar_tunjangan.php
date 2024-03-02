<?php 
    session_start(); 
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "zenithsalary";

    $koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if (!$koneksi) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }
    
    if(isset($_POST['save'])) {
        if(isset($_POST['tunjangan'])) {
            foreach($_POST['tunjangan'] as $selected) {
                // Lakukan sesuatu dengan nilai yang dipilih
                echo "Tunjangan dipilih: ".$selected."<br>";
            }
        } else {
            echo "Tidak ada tunjangan yang dipilih";
        }
    }
?>

<form method="post" action="">
<div>
                        <label class="control-label">Daftar Tunjangan</label>
                        <div class="controls">
                          <select class="form-control" name="id_daftar_tunjangan" required>
                          <option value=""> Pilih Daftar Tunjangan </option>
                            <?php $ambil="SELECT * FROM daftar_tunjangan";
                            $hasil=mysqli_query($koneksi, $ambil);
                            if (mysqli_num_rows($hasil) > 0) {
                            while ($pecah = mysqli_fetch_array($hasil)){?>
                            <option value="<?php echo $pecah['id_daftar_tunjangan'];?>">
                            <?php echo $pecah['id_daftar_tunjangan'];?></option>
                            <?php } } ?>
                          </select>
                        </div>
                    </div>
    <div class="form-check">
        <div class="col-md-4">
			<div class="form-group" style="max-height: 200px; overflow-y: auto;">
			<label for="id_tunjangan">Tunjangan :</label>
			<?php
				$ambil = $koneksi->query("SELECT * FROM tunjangan");
				while ($tunjangan = $ambil->fetch_assoc()) {
			?>
			<div class="form-check">
				<input type="checkbox" class="form-check-input" name="id_tunjangan[]" value="<?php echo $tunjangan['id_tunjangan']; ?>" id="<?php echo $tunjangan['id_tunjangan']; ?>">
				<label class="form-check-label" for="<?php echo $tunjangan['id_tunjangan']; ?>">
					<?php echo $tunjangan['nama_tunjangan']; ?>
				</label>
			</div>
			<?php } ?>
		    </div>
	    </div>    
    </div>
    <?php

?>

<div class="card-header">
    <button class="btn btn-primary" type="submit" name="save">Simpan</button>
</div>
</div>
</form>
<?php
if(isset($_POST['save']))
{
    
    $ambil = $koneksi->query("SELECT * FROM transaksi_tunjangan");
    if (isset($_POST['save'])) {
        $id_daftar_tunjangan = $_POST["id_daftar_tunjangan"];
        $sub_tot[]=0; $nof=0;
        foreach($_POST['id_tunjangan'] as $value){
            $ambil11 = $koneksi->query("SELECT * FROM transaksi_tunjangan JOIN tunjangan ON transaksi_tunjangan.id_tunjangan = tunjangan.id_tunjangan WHERE transaksi_tunjangan.id_tunjangan ='$value'");
            $pecah = $ambil11->fetch_assoc();
                $sub_tot[$nof]=$pecah['besar_tunjangan'];
                $koneksi->query("INSERT INTO transaksi_tunjangan (id_daftar_tunjangan,id_tunjangan, sub_total_tunjangan) 
                    VALUES ('$id_daftar_tunjangan','$value', $sub_tot[$nof])");
        $nof=$nof+1;
    }
        }
}
?>