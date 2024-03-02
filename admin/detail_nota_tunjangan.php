<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-13">
                <div class="card">
                    
                    <div class="card-body" style="overflow:auto">
                        <?php
                            include("config.php");
                            $id_nota_tunjangan = $_GET['id_nota_tunjangan'];
                            $q1 = mysqli_query($koneksi, "SELECT * FROM nota_tunjangan
                                JOIN karyawan ON nota_tunjangan.id_karyawan = karyawan.id_karyawan
                                JOIN divisi ON divisi.id_divisi = karyawan.id_divisi
                                JOIN jabatan ON jabatan.id_jabatan = karyawan.id_jabatan
                                JOIN golongan ON golongan.id_golongan = karyawan.id_golongan
                                WHERE nota_tunjangan.id_nota_tunjangan = '$id_nota_tunjangan';");
                            $qdata = mysqli_fetch_array($q1);
                        ?>
                        <table id="example2" class="table table-bordered table-striped">
                            <tr>
                                <td width=30%>Nama Karyawan</td>
                                <td width=70%><?php echo $qdata['nama_karyawan'] ?></td>
                            </tr>
                            <tr>
                                <td width=30%>ID Daftar tunjangan</td>
                                <td width=70%><?php echo $qdata['id_nota_tunjangan'] ?></td>
                            </tr>
                            <tr>
                                <td width=30%>Divisi</td>
                                <td width=70%><?php echo $qdata['nama_divisi'] ?></td>
                            </tr>
                            <tr>
                                <td width=30%>Jabtan</td>
                                <td width=70%><?php echo $qdata['nama_jabatan'] ?></td>
                            </tr>
                            <tr>
                                <td width=30%>Golongan</td>
                                <td width=70%><?php echo $qdata['nama_golongan'] ?></td>
                            </tr>
                        </table>
                    </div>

               <div class="card">
    <h5 class="card-header">Daftar tunjangan</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Karyawan</th>
                    <th>ID Daftar tunjangan</th>
                    <th>tunjangan</th>
                    <th>Sub Total tunjangan</th>
                    <th>Status Verifikasi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php
                $no = 1; // Inisialisasi nomor urut

                $ambil = $koneksi->query("SELECT * FROM transaksi_tunjangan 
                    JOIN nota_tunjangan on transaksi_tunjangan.id_nota_tunjangan=nota_tunjangan.id_nota_tunjangan
                    JOIN tunjangan on transaksi_tunjangan.id_tunjangan=tunjangan.id_tunjangan
                    INNER JOIN verifikasi ON nota_tunjangan.id_verifikasi=verifikasi.id_verifikasi
                    INNER JOIN karyawan ON nota_tunjangan.id_karyawan=karyawan.id_karyawan
                    WHERE nota_tunjangan.id_nota_tunjangan = '$_GET[id_nota_tunjangan]';");
                while ($pecah = $ambil->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $pecah['nama_karyawan']; ?></td>
                        <td><?php echo $pecah['id_nota_tunjangan']; ?></td>
                        <td><?php echo $pecah['nama_tunjangan']; ?></td>
                        <td><?php echo $pecah['sub_total_tunjangan']; ?></td>
                        <td><?php echo $pecah['nama_verifikasi']; ?></td>
                        <td>
                            <!-- Actions buttons go here -->
                        </td>
                    </tr>
                <?php
                    $no++;
                } ?>
            </tbody>
        </table>
    </div>
</div>
</div></div></div></div></section>
