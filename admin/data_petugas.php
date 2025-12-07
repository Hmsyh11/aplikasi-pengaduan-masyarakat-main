<div class="container-fluid">
    <div class="row">
        <div class="card">
            <div class="card-header d-flex pb-0">
                <h6>DATA PETUGAS</h6>
                <a href="" class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#tambah">Tambah Data</a>
            </div>
            <div class="card-body  px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table table-striped align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">No</th>
                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7 ps-2">Nama</th>
                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Username</th>
                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Telepon</th>
                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Level</th>
                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "../config/koneksi.php";

                            $query = mysqli_query($conn, "SELECT * FROM petugas"); //query data dari tabel petugas
                            $no = 1;
                            while ($data = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <td class="align-middle text-center text-sm"><?= $no++; ?></td>
                                    <td class="align-middle text-center text-sm"><?= $data['nama_petugas']; ?></td>
                                    <td class="align-middle text-center text-sm"><?= $data['username']; ?></td>
                                    <td class="align-middle text-center text-sm"><?= $data['telp']; ?></td>
                                    <td class="align-middle text-center text-sm"><?= $data['level']; ?></td>
                                    <td class="align-middle text-center">

                                        <!-- EDIT (BARU) -->
                                        <span class="badge badge-sm bg-warning">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#edit<?= $data['id_petugas'] ?>" style="text-decoration: none; color: white;">EDIT</a>
                                        </span>

                                        <!-- modal EDIT -->
                                        <div class="modal fade" id="edit<?= $data['id_petugas'] ?>" tabindex="-1" aria-labelledby="editLabel<?= $data['id_petugas'] ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="editLabel<?= $data['id_petugas'] ?>">Edit Data Petugas</h1>
                                                        <button type="button" class="btn-close bg-dark" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="" method="POST">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id_petugas" value="<?= $data['id_petugas']; ?>">

                                                            <div class="mb-3 text-start">
                                                                <label class="form-label">Nama Lengkap</label>
                                                                <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama_petugas']); ?>" required>
                                                            </div>

                                                            <div class="mb-3 text-start">
                                                                <label class="form-label">Username</label>
                                                                <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($data['username']); ?>" required>
                                                            </div>

                                                            <div class="mb-3 text-start">
                                                                <label class="form-label">Password (kosongkan jika tidak diganti)</label>
                                                                <input type="password" name="password" class="form-control" placeholder="Isi jika ingin ganti password">
                                                            </div>

                                                            <div class="mb-3 text-start">
                                                                <label class="form-label">No. Telepon</label>
                                                                <input type="number" name="telp" class="form-control" value="<?= htmlspecialchars($data['telp']); ?>" required>
                                                            </div>

                                                            <div class="mb-3 text-start">
                                                                <label class="form-label">Level</label>
                                                                <select name="level" class="form-control" required>
                                                                    <option value="admin"   <?= $data['level'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                                                                    <option value="petugas" <?= $data['level'] == 'petugas' ? 'selected' : ''; ?>>Petugas</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" name="update_petugas" class="btn btn-primary">Simpan Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /modal-EDIT -->
                                        <!-- /EDIT -->

                                        <!-- HAPUS -->
                                        <span class="badge badge-sm bg-danger">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#hapus<?= $data['id_petugas'] ?>" style="text-decoration: none; color: white;">HAPUS</a>
                                        </span>
                                        <!-- modal HAPUS -->
                                        <div class="modal fade" id="hapus<?= $data['id_petugas'] ?>" tabindex="-1" aria-labelledby="hapusLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="hapusLabel">Hapus Data</h1>
                                                        <button type="button" class="btn-close bg-dark" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="edit_data.php" method="POST">
                                                            <input type="hidden" name="id_petugas" class="form-control" value="<?= $data['id_petugas']; ?>">
                                                            <p>Yakin mau dihapus data <br> <?= $data['nama_petugas']; ?>?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="hapus_petugas" value="hapus_petugas" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- /modal-HAPUS -->
                                        <!-- /HAPUS -->
                                    </td>
                                </tr>
                            <?php  } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal TAMBAH PETUGAS-->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="verifikasiLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="verifikasiLabel">Tambah Data Petugas</h1>
                <button type="button" class="btn-close bg-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="row mb-3">
                        <label class="label col-md-4">Nama Lengkap</label>
                        <div class="col-md-8">
                            <input type="text" name="nama" class="form-control" placeholder="Masukan Nama" required autocomplete="off">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="label col-md-4">Username</label>
                        <div class="col-md-8">
                            <input type="text" name="username" class="form-control" placeholder="Masukan Username" required autocomplete="off">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="label col-md-4">Password</label>
                        <div class="col-md-8">
                            <input type="password" name="password" class="form-control" placeholder="Masukan Password" required autocomplete="off">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="label col-md-4">No.Telpon</label>
                        <div class="col-md-8">
                            <input type="number" name="telp" class="form-control" placeholder="Masukan Telpon" required autocomplete="off">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="kirim" class="btn btn-success">Kirim</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- /modal- TAMBAH PETUGAS -->

<?php
// pakai koneksi dari include di atas (sudah include "../config/koneksi.php")

// UPDATE DATA PETUGAS (BARU)
if (isset($_POST["update_petugas"])) {
    $id_petugas = mysqli_real_escape_string($conn, $_POST["id_petugas"]);
    $nama       = mysqli_real_escape_string($conn, $_POST["nama"]);
    $username   = mysqli_real_escape_string($conn, $_POST["username"]);
    $telp       = mysqli_real_escape_string($conn, $_POST["telp"]);
    $level      = mysqli_real_escape_string($conn, $_POST["level"]);
    $passBaru   = $_POST["password"];

    // kalau password diisi, update juga password (md5)
    if (!empty($passBaru)) {
        $password    = mysqli_real_escape_string($conn, md5($passBaru));
        $queryUpdate = "UPDATE petugas 
                        SET nama_petugas='$nama',
                            username='$username',
                            password='$password',
                            telp='$telp',
                            level='$level'
                        WHERE id_petugas='$id_petugas'";
    } else {
        // kalau password kosong, jangan overwrite password lama
        $queryUpdate = "UPDATE petugas 
                        SET nama_petugas='$nama',
                            username='$username',
                            telp='$telp',
                            level='$level'
                        WHERE id_petugas='$id_petugas'";
    }

    $update = mysqli_query($conn, $queryUpdate);

    if ($update) {
        echo "
            <script>
                alert('Data petugas berhasil diubah');
                document.location.href='index.php?page=petugas';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data petugas gagal diubah');
                document.location.href='index.php?page=petugas';
            </script>
        ";
    }
}

// INSERT DATA PETUGAS (ASLI, TETAP DIPAKAI)
if (isset($_POST["kirim"])) {

    //TANGKAP DATA DARI VAR POST DI DALAM FORM
    $nama     = $_POST["nama"];
    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    $telp     = $_POST["telp"];
    $level    = 'petugas';

    //INSERT DATA KE TABEL PETUGAS
    $query = mysqli_query($conn, "INSERT INTO petugas 
                        VALUES ('','$nama','$username','$password','$telp','$level') ");

    //Pengkondisian SETELAH INSERT AKAN DI BAWA KEMANA
    if ($query) {
        echo "
            <script>
                alert('Data Petugas Berhasil Ditambahkan');
                document.location.href='index.php?page=petugas';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data Petugas Gagal Ditambahkan');
                document.location.href='index.php?page=petugas';
            </script>
        ";
    }
}
?>
