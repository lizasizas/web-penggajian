<form method="POST">
    <div class="row">
        <div class="col-md-4">
            <label>Pilih Karyawan :</label>
            <select class="form-control" name="id_karyawan" id="id_karyawan" required>
                <option value="">Pilih Karyawan</option>
                <?php
                $ambil = $koneksi->query("SELECT * FROM karyawan");
                while ($karyawan = $ambil->fetch_assoc()) {
                    ?>
                    <option value="<?php echo $karyawan['id_karyawan']; ?>">
                        <?php echo $karyawan['nama_karyawan']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-4">
            <label>Daftar Tunjangan :</label>
            <select class="form-control" name="id_daftar_tunjangan" id="id_daftar_tunjangan" required>
                <option value="">Daftar Tunjangan</option>
            </select>
        </div>
        <div class="col-md-4">
            <label>Daftar Potongan :</label>
            <select class="form-control" name="id_daftar_potongan" id="id_daftar_potongan" required>
                <option value="">Daftar Potongan</option>
            </select>
        </div>
    </div>
    <button class="btn btn-primary" name="next"> Selanjutnya </button>
</form>

<?php
    if(isset($_POST["next"]))
    {
        $id_karyawan = $_POST['id_karyawan'];
        echo "<script>window.location = 'index.php?halaman=slip_gaji&id=id_karyawan'</script>";
    }
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#id_karyawan').change(function () {
            var idKaryawan = $(this).val();
            $.ajax({
                url: 'get_data.php',
                type: 'POST',
                data: { id_karyawan: idKaryawan },
                success: function (response) {
                    var result = JSON.parse(response);
                    $('#id_daftar_tunjangan').html(result.tunjangan);
                    $('#id_daftar_potongan').html(result.potongan);
                }
            });
        });
    });
</script>


<?php 







?>