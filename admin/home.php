<?php

include "../config/koneksi.php";
$masyarakat = mysqli_query($conn, "SELECT * FROM masyarakat"); //mengambil semua data dari tabel masyarakat
$jml_masyarakat = mysqli_num_rows($masyarakat); //menggunakan mysqli_num_rows untuk menghitung berapa data yg ada pada tabel masyarakat

$pengaduan = mysqli_query($conn, "SELECT * FROM pengaduan"); //mengambil semua data dari tabel pengaduan
$jml_pengaduan = mysqli_num_rows($pengaduan); //menggunakan mysqli_num_rows untuk menghitung berapa data yg ada pada tabel pengaduan

$tanggapan = mysqli_query($conn, "SELECT * FROM tanggapan"); //mengambil semua data dari tabel tanggapan
$jml_tanggapan = mysqli_num_rows($tanggapan); //menggunakan mysqli_num_rows untuk menghitung berapa data yg ada pada tabel tanggapan

$petugas = mysqli_query($conn, "SELECT * FROM petugas"); //mengambil semua data dari tabel petugas
$jml_petugas = mysqli_num_rows($petugas); //menggunakan mysqli_num_rows untuk menghitung berapa data yg ada pada tabel petugas

?>
<div class="container-fluid py-4">

    <?php if ($_SESSION['login'] == "admin") { ?>
        <!-- INFORMASI PENGGUNAAN DASHBOARD (BARU) -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-info" role="alert">
                    <h5 class="mb-2">Selamat datang di Dashboard Admin Aplikasi Pengaduan Masyarakat</h5>
                    <p class="mb-1">
                        Melalui halaman ini, admin dapat memantau dan mengelola seluruh aktivitas pengaduan masyarakat.
                        Gunakan menu yang tersedia di sidebar untuk:
                    </p>
                    <ul class="mb-1">
                        <li><strong>Data Pengaduan</strong> &mdash; melihat, memverifikasi status, memberi tanggapan, mengedit, dan menghapus pengaduan.</li>
                        <li><strong>Data Tanggapan</strong> &mdash; melihat, mengedit, dan menghapus tanggapan yang telah diberikan.</li>
                        <li><strong>Data Masyarakat</strong> &mdash; mengelola akun masyarakat (tambah, edit, hapus).</li>
                        <li><strong>Data Petugas</strong> &mdash; mengelola akun petugas dan admin (tambah, edit, hapus).</li>
                    </ul>
                    <p class="mb-0">
                        Pastikan setiap pengaduan ditindaklanjuti sesuai prosedur, dan status pengaduan selalu diperbarui agar informasi yang tampil kepada masyarakat tetap akurat.
                    </p>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="row">
        <?php if ($_SESSION['login'] == "admin") { ?>
            <!-- tanggapan -->
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Tanggapan</p>
                                    <h4 class="font-weight-bolder">
                                        <?= $jml_tanggapan; ?>
                                    </h4>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="ni ni-single-copy-04 text-light text-lg opacity-10"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- pengaduan -->
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Pengaduan</p>
                                    <h4 class="font-weight-bolder">
                                        <?= $jml_pengaduan; ?>
                                    </h4>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="ni ni-single-copy-04 text-light text-lg opacity-10"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- petugas -->
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Petugas</p>
                                    <h4 class="font-weight-bolder">
                                        <?= $jml_petugas; ?>
                                    </h4>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                    <i class="ni ni-single-02 text-light text-lg opacity-10"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- masyarakat -->
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Masyarakat</p>
                                    <h4 class="font-weight-bolder">
                                        <?= $jml_masyarakat; ?>
                                    </h4>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="ni ni-single-02 text-light text-lg opacity-10"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php  } else { ?>
            <!-- tanggapan -->
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Tanggapan</p>
                                    <h4 class="font-weight-bolder">
                                        <?= $jml_tanggapan; ?>
                                    </h4>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="ni ni-single-copy-04 text-light text-lg opacity-10"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- pengaduan -->
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Pengaduan</p>
                                    <h4 class="font-weight-bolder">
                                        <?= $jml_pengaduan; ?>
                                    </h4>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="ni ni-single-copy-04 text-light text-lg opacity-10"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php  } ?>
    </div>
</div>
