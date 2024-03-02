<?php
include("config.php");
session_start();
include("header.php");
?>

<div class="card">
    <div class="card-header py-1">
        <center><h2>Daftar Pengajuan potongan</h2></center>
    </div>
    <div class="card-body">
        <?php
        $id_nota_potongan = $_GET['id_nota_potongan'];
            $ambildata = mysqli_query($koneksi, "SELECT * FROM nota_potongan 
            JOIN karyawan ON nota_potongan.id_karyawan = karyawan.id_karyawan
            JOIN transaksi_potongan ON transaksi_potongan.id_nota_potongan = nota_potongan.id_nota_potongan
            JOIN potongan ON transaksi_potongan.id_potongan = potongan.id_potongan
            WHERE nota_potongan.id_nota_potongan = '$id_nota_potongan'");
            $db = $ambildata->fetch_assoc() 
            ?>
            <div class="nota-container" style="background-color: #fff; border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 20px; margin-bottom: 20px;">
                <div class="table-container" style="margin: 20px 0;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th style="border: 1px solid #ddd; padding: 10px; width: 18%;">Nama Karyawan</th>
                                <th style="border: 1px solid #ddd; padding: 10px; width: 18%;">Tanggal Pengajuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="border: 1px solid #ddd; padding: 10px;"><?php echo $db['nama_karyawan']; ?></td>
                                <td style="border: 1px solid #ddd; padding: 10px;"><?php echo $db['tanggal_pengajuan']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>

                <h4>Rincian Daftar Pengajuan potongan</h4>
                <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                    <thead>
                        <tr style="background-color: #f2f2f2;">
                            <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">No. </th>
                            <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Nama potongan</th>
                            <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Keterangan</th>
                            <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Besar potongan</th>
                            <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Lama Potongan</th>
                            <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Tanggal Mulai</th>
                            <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Tanggal Selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $id_nota_potongan = $_GET['id_nota_potongan'];
                        $ambil = $koneksi->query("SELECT * FROM transaksi_potongan 
                        JOIN potongan ON transaksi_potongan.id_potongan = potongan.id_potongan
                        WHERE id_nota_potongan='$id_nota_potongan'");
                        $nomor = 1; // Inisialisasi nomor
                        while ($data = $ambil->fetch_assoc()) {?>
                            <tr style="border: 1px solid #dddddd;">
                                <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;"><?php echo $nomor; ?></td>
                                <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;"><?php echo $data['nama_potongan']; ?></td>
                                <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;"><?php echo $data['keterangan_potongan']; ?></td>
                                <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;"><?php echo $data['sub_total_potongan']; ?></td>
                                <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;"><?php echo $data['lama_potongan']; ?></td>
                                <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;"><?php echo $data['tanggal_mulai']; ?></td>
                                <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;"><?php echo $data['tanggal_selesai']; ?></td>
                            </tr>
                        <?php 
                        $nomor++; // Increment nomor setiap kali loop
                        } ?>
                    </tbody>
                </table>


                <div class="button-section" style="margin-top: 20px; text-align: center;">
                    <a href="riwayat_potongan.php" class="btn btn-purple"> Kembali </a>
                </div>
            </div>

            <hr>


    </div>
</div>