<h4><span class="text-muted fw-light"> Nota potongan |</span> Nota Potongan</h4>
<div>
              <form class="form-horizontal" role="search" method="post" action="index.php?halaman=cari_nota_potongan">
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
                <h5 class="card-header">Nota Potongan</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>ID Nota Potongan</th>
                        <th>Nama Karyawan</th>
                        <th>Total Potongan</th>
                        <th>Lampiran </th>
                        <th> Verifikasi </th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php $no=1; ?>
                        <?php $ambil=$koneksi->query("SELECT * FROM nota_potongan 
                          JOIN karyawan ON nota_potongan.id_karyawan=karyawan.id_karyawan
                          JOIN verifikasi ON nota_potongan.id_verifikasi=verifikasi.id_verifikasi
                          JOIN transaksi_potongan ON transaksi_potongan.id_nota_potongan = nota_potongan.id_nota_potongan
                        ;");?>
                        <?php while($pecah = $ambil->fetch_assoc()){?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $pecah['id_nota_potongan']; ?></td>
                          <td><?php echo $pecah['nama_karyawan']; ?></td>
                          <td><?php echo number_format ($pecah['total_potongan']); ?></td>
                          <td><?php echo $pecah['lampiran_potongan']; ?></td>
                          <td><?php echo $pecah['nama_verifikasi']; ?></td>
                        
                          <td class='action'>

                           <?php if($pecah['nama_verifikasi']=="Ditolak"):?>
                            <a href="index.php?halaman=hapus_nota_potongan&id_nota_potongan=<?php echo $pecah['id_nota_potongan']?>" class="btn btn-secondary">Hapus</a>
                            <a href="index.php?halaman=ubah_nota_potongan&id_nota_potongan=<?php echo $pecah['id_nota_potongan']?>" class="btn btn-secondary">Detail</a>
                              <?php endif?>


                           <?php if($pecah['nama_verifikasi']=="Disetujui"):?>
                            <a href="index.php?halaman=hapus_nota_potongan&id_nota_potongan=<?php echo $pecah['id_nota_potongan']?>" class="btn btn-secondary">Hapus</a>
                            <a href="index.php?halaman=ubah_nota_potongan&id_nota_potongan=<?php echo $pecah['id_nota_potongan']?>" class="btn btn-secondary">Detail</a>
                              <?php endif?>

                          <?php if($pecah['nama_verifikasi']=="Sedang Diproses"):?>
                             <a href="index.php?halaman=hapus_nota_potongan&id_nota_potongan=<?php echo $pecah['id_nota_potongan']?>" class="btn btn-secondary">Hapus</a>
                            <a href="index.php?halaman=ubah_verifikasi_nota&id_nota_potongan=<?php echo $pecah['id_nota_potongan']?>" class="btn btn-secondary">Verifikasi</a>
                            <a href="index.php?halaman=ubah_nota_potongan&id_nota_potongan=<?php echo $pecah['id_nota_potongan']?>" class="btn btn-secondary">Detail</a>
                          </td>
                              <?php endif?>

                      
                        </tr>
                        <?php $no++; ?>
                        <?php } ?>
                    </tbody>
                  </table>
                  
                </div>
              </div>
</div>