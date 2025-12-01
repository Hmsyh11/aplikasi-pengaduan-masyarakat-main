<div class="container">
    <div class="row">
        <div class="col-md-12 mt-3">

            <div; class="card">
                <div class="card-header d-flex pb-0">
                    <h6>PENGADUAN</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table table-striped align-items-center mb-0">
                            <thead class="text-center">
                                <tr>
                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">No</th>
                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Judul</th>
                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Isi</th>
                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Foto</th>
                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php $no = 1; ?>
                                <?php
                                include "../config/koneksi.php";
                                //menampung data nik dari session yang dibuat setelah login
                                $nik = $_SESSION['nik'];
                                $query = mysqli_query($conn, "SELECT * FROM pengaduan WHERE nik = '$nik'"); //menampilkan data pengaduan
                                while ($data = mysqli_fetch_array($query)) { ?>
                                    <tr>
                                        <td class="align-middle text-center text-sm">
                                            <?= $no++; ?>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <?= $data['judul_pengaduan']; ?>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <?= $data['isi_laporan']; ?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <?php if (!empty($data['foto'])) { ?>
                                                <img src="../database/img/<?= $data['foto']; ?>" alt="Ini Foto" width="70px">
                                            <?php } else { ?>
                                                <span class="text-secondary text-xs">Tidak ada foto</span>
                                            <?php } ?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php
                                                if ($data['status'] == "selesai") {
                                                    echo "<span class='badge bg-success text-light'>Selesai</span>";
                                                    echo "<br><a href='index.php?page=tanggapan&id_pengaduan=$data[id_pengaduan]'>lihat tanggapan<a>";
                                                } elseif ($data['status'] == "proses") {
                                                    echo "<span class='badge bg-warning text-dark'>Proses</span>";
                                                } elseif ($data['status'] == "tolak") {
                                                    echo "<span class='badge bg-danger text-light'>Ditolak</span>";
                                                } else {
                                                    echo "<span class='badge bg-danger text-light'>Menunggu</span>";
                                                }
                                                ?>
                                            </span>
                                        </td>
                                        <td>
                                            <!-- HAPUS -->
                                            <a href="#" data-bs-toggle="modal" class="btn btn-danger btn-sm" data-bs-target="#hapus<?= $data['id_pengaduan'] ?>" style="text-decoration:none; color:white;">HAPUS</a>
                                            <!-- modal HAPUS -->
                                            <div class="modal fade" id="hapus<?= $data['id_pengaduan'] ?>" tabindex="-1" aria-labelledby="hapusLabel<?= $data['id_pengaduan'] ?>" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="hapusLabel<?= $data['id_pengaduan'] ?>">Hapus Data</h1>
                                                            <button type="button" class="btn-close bg-dark " data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="edit_data.php" method="POST">
                                                                <input type="hidden" name="id_pengaduan" class="form-control" value="<?= $data['id_pengaduan']; ?>">
                                                                <p>Yakin mau dihapus data <br> <strong><?= $data['judul_pengaduan']; ?></strong>?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" name="hapus_pengaduan" value="hapus_pengaduan" class="btn btn-danger">Hapus</button>
                                                        </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /modal-HAPUS -->
                                            <!-- /HAPUS -->

                                            <!-- EDIT -->
                                            <a href="#" data-bs-toggle="modal" class="btn btn-primary btn-sm mt-1" data-bs-target="#edit<?= $data['id_pengaduan'] ?>" style="text-decoration:none; color:white;">EDIT</a>

                                            <!-- modal EDIT -->
                                            <div class="modal fade" id="edit<?= $data['id_pengaduan'] ?>" tabindex="-1" aria-labelledby="editLabel<?= $data['id_pengaduan'] ?>" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="editLabel<?= $data['id_pengaduan'] ?>">Edit Pengaduan</h1>
                                                            <button type="button" class="btn-close bg-dark" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="edit_data.php" method="POST" enctype="multipart/form-data">
                                                            <div class="modal-body">

                                                                <input type="hidden" name="id_pengaduan" value="<?= $data['id_pengaduan']; ?>">
                                                                <input type="hidden" name="foto_lama" value="<?= $data['foto']; ?>">

                                                                <div class="mb-3 text-start">
                                                                    <label class="form-label">Judul Pengaduan</label>
                                                                    <input type="text" name="judul_pengaduan" class="form-control" value="<?= htmlspecialchars($data['judul_pengaduan']); ?>" required>
                                                                </div>

                                                                <div class="mb-3 text-start">
                                                                    <label class="form-label">Isi Laporan</label>
                                                                    <textarea name="isi_laporan" class="form-control" rows="4" required><?= htmlspecialchars($data['isi_laporan']); ?></textarea>
                                                                </div>

                                                                <div class="mb-3 text-start">
                                                                    <label class="form-label">Foto Saat Ini</label><br>
                                                                    <?php if (!empty($data['foto'])) : ?>
                                                                        <img src="../database/img/<?= $data['foto']; ?>" alt="Foto Pengaduan" width="120">
                                                                    <?php else : ?>
                                                                        <span class="text-secondary text-xs">Tidak ada foto</span>
                                                                    <?php endif; ?>
                                                                </div>

                                                                <div class="mb-3 text-start">
                                                                    <label class="form-label">Ganti Foto (opsional)</label>
                                                                    <input type="file" name="foto" class="form-control" accept="image/*">
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" name="edit_pengaduan" class="btn btn-primary">Simpan Perubahan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /modal-EDIT -->
                                            <!-- /EDIT -->
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</div>
