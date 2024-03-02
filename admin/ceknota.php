<?php 
include "config.php"; 

$tanggal = date("Y-m-d");
$cekdata = $koneksi->query("SELECT * FROM transaksi_potongan 
    JOIN nota_potongan ON nota_potongan.id_nota_potongan = transaksi_potongan.id_nota_potongan 
    JOIN potongan ON transaksi_potongan.id_potongan = potongan.id_potongan 
    WHERE id_verifikasi = 'IDV01'");

while ($pecah = $cekdata->fetch_assoc()) {
    if ($pecah['tanggal_selesai'] <= $tanggal) {
        $sql = $koneksi->query("UPDATE transaksi_potongan SET id_status='IDSP02' WHERE tanggal_selesai<='$tanggal'");
    }
}
?>
