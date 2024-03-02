<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-15">
                <div class="card">
                    
                    <div class="card-body" style="overflow:auto">
                        <?php
                            include("config.php");
                             $id_nota_potongan = $_GET['id_nota_potongan'];
                            $q1 = mysqli_query($koneksi, "SELECT * FROM karyawan
                                JOIN nota_potongan ON nota_potongan.id_karyawan = karyawan.id_karyawan
                                JOIN divisi ON divisi.id_divisi = karyawan.id_divisi
                                JOIN jabatan ON jabatan.id_jabatan = karyawan.id_jabatan
                                JOIN golongan ON golongan.id_golongan = karyawan.id_golongan
                                   WHERE nota_potongan.id_nota_potongan = '$id_nota_potongan';");
                            $qdata = mysqli_fetch_array($q1);
                        ?>
                        <table id="example2" class="table table-borderles">
                            <tr>
                                <td width=30%>Nama Karyawan</td>
                                <td width=70%><?php echo $qdata['nama_karyawan'] ?></td>
                            </tr>
                            <tr>
                                <td width=30%>ID Daftar Potongan</td>
                                <td width=70%><?php echo $qdata['id_nota_potongan'] ?></td>
                            </tr>
                            <tr>
                                <td width=30%>Divisi</td>
                                <td width=70%><?php echo $qdata['nama_divisi'] ?></td>
                            </tr>
                            <tr>
                                <td width=30%>Jabatan</td>
                                <td width=70%><?php echo $qdata['nama_jabatan'] ?></td>
                            </tr>
                            <tr>
                                <td width=30%>Golongan</td>
                                <td width=70%><?php echo $qdata['nama_golongan'] ?></td>
                            </tr>
                        </table>
                    </div>

               <div class="card">
    <h5 class="card-header">Daftar Potongan</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Potongan</th>
                    <th>Keterangan</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Besar Potongan</th>
                    <th>Lama Potongan</th>
                    <th>Cicilan Per Bulan</th>
                    <th>Status Verifikasi</th>
                    <th>Status Potongan</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php
                 $no = 1; // Inisialisasi nomor urut
                $ambil = $koneksi->query("SELECT * FROM transaksi_potongan 
                    join nota_potongan on transaksi_potongan.id_nota_potongan=nota_potongan.id_nota_potongan
                    join potongan on transaksi_potongan.id_potongan=potongan.id_potongan
                    INNER JOIN verifikasi ON nota_potongan.id_verifikasi=verifikasi.id_verifikasi
                    INNER JOIN karyawan ON nota_potongan.id_karyawan=karyawan.id_karyawan
                    INNER JOIN status_potongan ON transaksi_potongan.id_status = status_potongan.id_status
                    WHERE nota_potongan.id_nota_potongan = '$_GET[id_nota_potongan]';");
                while ($pecah = $ambil->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $pecah['nama_potongan']; ?></td>
                        <td><?php echo $pecah['keterangan_potongan']; ?></td>
                        <td><?php echo $pecah['tanggal_mulai']; ?></td>
                        <td><?php echo $pecah['tanggal_selesai']; ?></td>
                        <td><?php echo $pecah['sub_total_potongan']; ?></td>
                        <td><?php echo $pecah['lama_potongan']; ?></td>
                         <td><?php echo $pecah['cicilan']; ?></td>
                        <td><?php echo $pecah['nama_verifikasi']; ?></td>
                        <td><?php echo $pecah['nama_status']; ?></td>
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
