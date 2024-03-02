<h4><span class="text-muted fw-light"> Data Karyawan |</span> Status Nikah</h4>
<div>
              <form class="form-horizontal" role="search" method="post" action="index.php?halaman=cari_status_nikah">
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
                    <a href="index.php?halaman=tambah_status_nikah" class="btn btn-info">Tambah Data</a>
                  </div>
                </div>
              </form>
</div>
              
              <!-- Hoverable Table rows -->
              <div class="card">
                <h5 class="card-header">Data status_nikah</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>ID statusnikah</th>
                        <th>Nama status nikah</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php $no=1; ?>
                        <?php $ambil=$koneksi->query("SELECT * FROM status_nikah ");?>
                        <?php while($pecah = $ambil->fetch_assoc()){?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $pecah['id_status_nikah']; ?></td>
                          <td><?php echo $pecah['nama_status_nikah']; ?></td>
                          <td class='action'>
                            <a href="index.php?halaman=ubah_status_nikah&id_status_nikah=<?php echo $pecah['id_status_nikah']?>" class="btn btn-primary">edit</a>
                            <a href="hapus_status_nikah.php?id_status_nikah=<?php echo $pecah['id_status_nikah']?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data?')" class="btn btn-danger" name="hapus" class="btn-danger btn">hapus</a>
                          </td>
                        </tr>
                        <?php $no++; ?>
                        <?php } ?>
                    </tbody>
                  </table>
                  
                </div>
              </div>