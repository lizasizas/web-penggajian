<?php
// Koneksi ke database dan query untuk mengambil besar tunjangan berdasarkan ID
include("config.php");
$selectedTunjanganId = $_GET['id']; // Ambil ID dari URL

// Lakukan query untuk mengambil besar tunjangan
// Gantilah query ini sesuai dengan struktur tabel dan hubungan antara tabel
$query = $koneksi->query("SELECT besar_tunjangan FROM tunjangan WHERE id_tunjangan = '$selectedTunjanganId'");
$data = $query->fetch_assoc();

// Keluarkan nilai besar tunjangan dalam format dropdown option
echo '<option value="'.$data['besar_tunjangan'].'">'.$data['besar_tunjangan'].'</option>';
?>
