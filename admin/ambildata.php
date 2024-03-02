<?php
// get_data.php
// Lakukan koneksi ke database
include("config.php");

if (isset($_POST['id_karyawan'])) {
    $id_karyawan = $_POST['id_karyawan'];

    $tunjanganOptions = '';
    $potonganOptions = '';

    // Query untuk daftar tunjangan
    $queryTunjangan = $koneksi->query("SELECT * FROM daftar_tunjangan WHERE id_karyawan = '$id_karyawan'");
    while ($tunjangan = $queryTunjangan->fetch_assoc()) {
        $tunjanganOptions .= '<option value="' . $tunjangan['id_daftar_tunjangan'] . '">';
        $tunjanganOptions .= $tunjangan['id_daftar_tunjangan']; // Ganti dengan kolom yang sesuai
        $tunjanganOptions .= '</option>';
    }

    // Query untuk daftar potongan
    $queryPotongan = $koneksi->query("SELECT * FROM daftar_potongan WHERE id_karyawan = '$id_karyawan'");
    while ($potongan = $queryPotongan->fetch_assoc()) {
        $potonganOptions .= '<option value="' . $potongan['id_daftar_potongan'] . '">';
        $potonganOptions .= $potongan['id_daftar_potongan']; // Ganti dengan kolom yang sesuai
        $potonganOptions .= '</option>';
    }

    // Mengembalikan hasil dalam format JSON
    echo json_encode(['tunjangan' => $tunjanganOptions, 'potongan' => $potonganOptions]);
}
?>