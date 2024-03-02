<h4><span class="text-muted fw-light"> Data Golongan |</span> Jenis Golongan</h4>
<div>
              <form class="form-horizontal" role="search" method="post" action="index.php?halaman=cari_golongan">
                <div class="row py-2 mb-2">
                  <div class="col-md-3">
                    <div class="form-group">
                      <input type="text" class="form-control" name="keyword" placeholder="Quick search..." autofocus autocomplete="off">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <button class="btn btn-primary" name="cari">Cari</button>
                  </div>
                  <div class="col-md-7 d-flex justify-content-end">
                    <a href="index.php?halaman=tambah_golongan" class="btn btn-info">Tambah Data</a>
                  </div>
                </div>
              </form>
</div>
              
              <!-- Hoverable Table rows -->
              <div class="card">
                <h5 class="card-header">Data Jenis Golongan</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>ID Golongan</th>
                        <th>Nama Golongan</th>
                        <th>Gaji Pokok</th>
                        <th>Persen Pajak</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php $no=1; ?>
                        <?php $ambil=$koneksi->query("SELECT * FROM golongan ");?>
                        <?php while($pecah = $ambil->fetch_assoc()){?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $pecah['id_golongan']; ?></td>
                          <td><?php echo $pecah['nama_golongan']; ?></td>
                          <td>Rp <?php echo number_format ($pecah['gaji_pokok']); ?></td>
                          <td><?php echo $pecah['persen_pajak']; ?></td>
                          <td class='action'>
                            <a href="index.php?halaman=ubah_golongan&id_golongan=<?php echo $pecah['id_golongan']?>" class="btn btn-primary">edit</a>
                            <a href="hapus_golongan.php?id_golongan=<?php echo $pecah['id_golongan']?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data?')" class="btn btn-danger" name="hapus" class="btn-danger btn">hapus</a>
                          </td>
                        </tr>
                        <?php $no++; ?>
                        <?php } ?>
                    </tbody>
                  </table>
                  
                </div>
              </div>