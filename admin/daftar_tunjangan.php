<h4><span class="text-muted fw-light"> Data Tunjangan |</span> nota Tunjangan</h4>
<div>
              <form class="form-horizontal" role="search" method="post" action="index.php?halaman=cari_nota_tunjangan">
                <div class="row py-2 mb-2">
                  <div class="col-md-3">
                    <div class="form-group">
                      <input type="text" class="form-control" name="keyword" placeholder="Quick search..." autofocus autocomplete="off">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <button class="btn btn-primary" name="cari">Cari</button>
                  
                </div>
              </form>
</div>
              
              <!-- Hoverable Table rows -->
              <div class="card">
                <h5 class="card-header">Data nota Tunjangan</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>ID Nota Tunjangan</th>
                        <th>Nama Karyawan</th>
                        <th>Total</th>
                        <th>Tunjangan</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php $no=1; ?>
                        <?php $ambil=$koneksi->query("SELECT * FROM transaksi_tunjangan
                        JOIN nota_tunjangan ON nota_tunjangan.id_nota_tunjangan = transaksi_tunjangan.id_nota_tunjangan
                        JOIN karyawan ON karyawan.id_karyawan = nota_tunjangan.id_karyawan
                        JOIN tunjangan ON tunjangan.id_tunjangan = transaksi_tunjangan.id_tunjangan
                        GROUP BY transaksi_tunjangan.id_nota_tunjangan
                        ORDER BY transaksi_tunjangan.id_nota_tunjangan;");?>

                        <?php while($pecah = $ambil->fetch_assoc()){?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $pecah['id_nota_tunjangan']; ?></td>
                          <td><?php echo $pecah['nama_karyawan']; ?></td>
                          <td><?php echo $pecah['total_tunjangan']; ?></td>
                          <td class='action'>
                            <a href="index.php?halaman=tambah_nota_tunjangan&id_nota_tunjangan=<?php echo $pecah['id_nota_tunjangan']?>" class="btn btn-primary">Detail</a>
                          </td>
                          <td class='action'>
                            <a href="index.php?halaman=ubah_nota_tunjangan&id_nota_tunjangan=<?php echo $pecah['id_nota_tunjangan']?>" class="btn btn-warning">edit</a>
                            <a href="hapus_nota_tunjangan.php?id_nota_tunjangan=<?php echo $pecah['id_nota_tunjangan']?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data?')" class="btn btn-danger" name="hapus" class="btn-danger btn">hapus</a>
                          </td>
                        </tr>
                        <?php $no++; ?>
                        <?php } ?>
                    </tbody>
                  </table>
                </div>
                </div>
              </div>


              