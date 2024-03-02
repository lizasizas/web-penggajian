<h4><span class="text-muted fw-light"> Data jabatan |</span> Nama Jabatan</h4>
<div>
              <form class="form-horizontal" role="search" method="post" action="index.php?halaman=cari_jabatan">
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
                    <a href="index.php?halaman=tambah_jabatan" class="btn btn-info">Tambah Data</a>
                  </div>
                </div>
              </form>
</div>
              
              <!-- Hoverable Table rows -->
              <div class="card">
                <h5 class="card-header">Data Jabatan</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>ID Jabatan</th>
                        <th>Nama Jabatan</th>
                        <th>Tunjangan Jabatan</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php $no=1; ?>
                        <?php $ambil=$koneksi->query("SELECT * FROM jabatan ");?>
                        <?php while($pecah = $ambil->fetch_assoc()){?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $pecah['id_jabatan']; ?></td>
                          <td><?php echo $pecah['nama_jabatan']; ?></td>
                          <td>Rp <?php echo number_format ($pecah['tunjangan_jabatan']); ?></td>
                          <td class='action'>
                            <a href="index.php?halaman=ubah_jabatan&id_jabatan=<?php echo $pecah['id_jabatan']?>" class="btn btn-primary">edit</a>
                            <a href="hapus_jabatan.php?id_jabatan=<?php echo $pecah['id_jabatan']?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data?')" class="btn btn-danger" name="hapus" class="btn-danger btn">hapus</a>
                          </td>
                        </tr>
                        <?php $no++; ?>
                        <?php } ?>
                    </tbody>
                  </table>
                  
                </div>
              </div>