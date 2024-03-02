<?php
$koneksi = new mysqli("localhost", "root", "", "zenithsalary");

$query1 = mysqli_query($koneksi, "SELECT max(id_slip_gaji) as kodeTerbesar FROM slip_gaji");
$data1 = mysqli_fetch_array($query1);
$id_slip_gaji = $data1['kodeTerbesar'];

$urutan = (int) substr($id_slip_gaji, 3, 3);
$urutan++;

$huruf = "SLP";
$id_slip_gaji = $huruf . sprintf("%03s", $urutan);
?>

<h4><span class="text-muted fw-light"> Slip Gaji Karyawan |</span> Slip Gaji</h4>

<div class="card">
    <form method="post">
        <h5 class="card-header">Tambah Data</h5>

        <div class="card-header">

            <div class="form-group">
                <label>Nama Karyawan</label>
                <select class="form-control" name="id_karyawan" required>
                    <option></option>
                    <?php
                    $ambil = $koneksi->query("SELECT * FROM karyawan 
                        ");
                    while ($pecah = $ambil->fetch_assoc()) {
                        echo '<option value="' . $pecah['id_karyawan'] . '">' . $pecah['id_karyawan'] . '--' . $pecah['nama_karyawan'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label>Tanggal Slip Gaji</label>
                <input type="date" class="form-control" name="tanggal">
            </div>
        </div>

        <div class="card-header">
            <button class="btn btn-primary" name="save">Simpan</button>
        </div>
    </form>

    <?php
    if (isset($_POST["save"])) {

        //buat id slip gaji
        $query=mysqli_query($koneksi, "SELECT max(id_slip_gaji) as kodeTerbesar FROM slip_gaji");
        $data=mysqli_fetch_array($query);
        $id_slip_gaji=$data['kodeTerbesar'];
        $urutan=(int) substr($id_slip_gaji,5,3);
        $urutan++;
        $huruf="IDSG";
        $id_slip_gaji = $huruf . sprintf("%03s", $urutan);

        //ngambil potongan untuk perhitungan
        $id_karyawan = $_POST['id_karyawan'];
        $tanggal = $_POST['tanggal'];
        $ambil = $koneksi->query("SELECT SUM(cicilan) as totalp FROM transaksi_potongan 
            JOIN nota_potongan ON nota_potongan.id_nota_potongan = transaksi_potongan.id_nota_potongan 
            WHERE nota_potongan.id_karyawan = '$id_karyawan' AND '$tanggal' BETWEEN tanggal_mulai AND tanggal_selesai AND id_verifikasi = 'IDV01'");
        $pecah = $ambil->fetch_assoc();
        $total_p = $pecah['totalp'];

        //ngambil tunjangan untuk perhitungan
        $ambiltjg = $koneksi->query("SELECT tunjangan_jabatan FROM jabatan JOIN karyawan ON jabatan.id_jabatan = karyawan.id_jabatan WHERE id_karyawan = '$id_karyawan'");
        $pecahtjg = $ambiltjg->fetch_assoc();
        $tunjangan_jabatan= $pecahtjg['tunjangan_jabatan'];

        $ambilt = $koneksi->query("SELECT SUM(sub_total_tunjangan) as totalt FROM transaksi_tunjangan
            JOIN nota_tunjangan ON nota_tunjangan.id_nota_tunjangan = transaksi_tunjangan.id_nota_tunjangan 
            WHERE nota_tunjangan.id_karyawan = '$id_karyawan' AND nota_tunjangan.id_verifikasi = 'IDV01'");
        $pecaht = $ambilt->fetch_assoc();
        $total_t = $pecaht['totalt'] +  $pecahtjg['tunjangan_jabatan'];

        //ambil gaji pokok
        $ambilk = $koneksi->query("SELECT gaji_pokok FROM golongan JOIN karyawan ON golongan.id_golongan = karyawan.id_golongan
         WHERE id_karyawan = '$id_karyawan'");
        $pecahk = $ambilk->fetch_assoc();
        $gaji_pokok = $pecahk['gaji_pokok'];

        //perhitungan gaji bersih
        $gaji_bersih = $gaji_pokok - $total_p + $total_t;  

        $sql = $koneksi->query("INSERT INTO slip_gaji(id_slip_gaji,tanggal, id_karyawan, gaji_pokok, gaji_bersih, tunjangan_jabatan) VALUES('$id_slip_gaji', '$tanggal', '$id_karyawan', '$gaji_pokok', '$gaji_bersih','$tunjangan_jabatan')");

        if ($sql) {
            echo "<script>alert('Data berhasil ditambahkan'); window.location = 'index.php?halaman=slip_gaji'</script>";
        } else {
            echo "<script>alert('Proses gagal'); window.location = 'index.php?halaman=slip_gaji'</script>";
        }
    }
    ?>
</div>