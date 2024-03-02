<?php
include 'config.php';

$semuadata = array();
$tgl_mulai = "-";
$tgl_selesai = "-";
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <center>
            <h5 class="m-0 font-weight-bold text-dark">LAPORAN PENGELUARAN GAJI</h5>
        </center>
    </div>

    <form action="index.php?halaman=laporan_pengeluaran" method="POST" class="form">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Tanggal Mulai</label>
                        <input type="date" class="form-control" name="tgl1">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Tanggal Selesai</label>
                        <input type="date" class="form-control" name="tgl2">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group mt-4">
                        <button name="proses" class="btn btn-primary"><i class="fa fa-play-circle-o"></i> Lihat</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div>
    <?php
    if (isset($_POST['proses'])) {
        $dt1 = $_POST['tgl1'];
        $dt2 = $_POST['tgl2'];

        if (empty($dt1) || empty($dt2)) {
            echo "<p class='text-danger'>Tanggal Mulai dan Tanggal Selesai harus diisi.</p>";
        } else {
            echo "<br><p><b>Informasi:</b> Hasil pencarian data periode Tanggal <b>$dt1</b> s/d <b>$dt2</b></p>";

            $query = "SELECT * FROM slip_gaji
                    JOIN karyawan ON slip_gaji.id_karyawan = karyawan.id_karyawan
                    WHERE tanggal BETWEEN '$dt1' AND '$dt2'";

            $result = mysqli_query($koneksi, $query);

            if ($result) {
    ?>
    <div>
                <br>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>ID Slip Gaji</th>
                            <th>Nama Karyawan</th>
                            <th>Tanggal Slip Gaji</th>
                            <th>Gaji Bersih</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        $nomor = 1;

                        while ($pecah = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <td><?php echo $nomor; ?></td>
                                <td><?php echo $pecah['id_slip_gaji']; ?></td>
                                <td><?php echo $pecah['nama_karyawan']; ?></td>
                                <td><?php echo date("d F Y", strtotime($pecah["tanggal"])); ?></td>
                                <td>Rp. <?php echo number_format($pecah['gaji_bersih']); ?></td>
                            </tr>
                            <?php $total += $pecah['gaji_bersih']; ?>
                            <?php $nomor++; ?>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4"><center>Total</th>
                            <th>Rp. <?php echo number_format($total); ?></th>
                        </tr>
                    </tfoot>
                </table>
                <?php
            } else {
                echo "<p class='text-danger'>Error in query: " . mysqli_error($koneksi) . "</p>";
            }
        }
    }
    ?>
    </div>
</div>
</div>
