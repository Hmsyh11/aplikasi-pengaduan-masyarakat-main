<?php
require "../config/koneksi.php";

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION["nik"])) {
    header("Location: ../index.php?page=login");
    exit;
}

$nik  = $_SESSION["nik"];
$nama = $_SESSION["nama"];

// hitung jumlah pengaduan user
$q_total   = mysqli_query($conn, "SELECT id_pengaduan FROM pengaduan WHERE nik='$nik'");
$jml_total = mysqli_num_rows($q_total);

$q_proses   = mysqli_query($conn, "SELECT id_pengaduan FROM pengaduan WHERE nik='$nik' AND status='proses'");
$jml_proses = mysqli_num_rows($q_proses);

$q_selesai   = mysqli_query($conn, "SELECT id_pengaduan FROM pengaduan WHERE nik='$nik' AND status='selesai'");
$jml_selesai = mysqli_num_rows($q_selesai);

$q_tolak   = mysqli_query($conn, "SELECT id_pengaduan FROM pengaduan WHERE nik='$nik' AND status='tolak'");
$jml_tolak = mysqli_num_rows($q_tolak);
?>

<div class="container-fluid py-4">
    <div class="row mb-3">
        <div class="col-12">
            <h4 class="mb-1">Selamat Datang, <?= htmlspecialchars($nama); ?> 👋</h4>
            <p class="text-muted mb-0">
                Ini adalah halaman utama akun Anda. Gunakan menu di atas untuk membuat pengaduan baru
                atau melihat riwayat pengaduan yang sudah pernah Anda kirim.
            </p>
        </div>
    </div>

    <!-- Informasi penggunaan singkat -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="mb-2">Informasi Penggunaan Aplikasi</h6>
                    <ul class="mb-2">
                        <li><strong>Form Pengaduan</strong> digunakan untuk membuat laporan baru.</li>
                        <li><strong>Daftar Pengaduan</strong> menampilkan seluruh laporan yang pernah Anda kirim.</li>
                        <li>Status pengaduan dapat berupa <strong>Menunggu</strong>, <strong>Proses</strong>, <strong>Selesai</strong>, atau <strong>Ditolak</strong>.</li>
                        <li>Untuk pengaduan yang <strong>selesai</strong>, Anda dapat melihat balasan petugas pada menu <strong>Daftar Pengaduan</strong> → Lihat Tanggapan.</li>
                    </ul>
                    <p class="mb-0 text-muted">
                        Sampaikan laporan dengan jelas dan lengkap agar petugas dapat menindaklanjuti dengan lebih cepat.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Kartu statistik -->
    <div class="row">
        <!-- Total Pengaduan -->
        <div class="col-xl-3 col-sm-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Pengaduan</p>
                            <h4 class="font-weight-bolder mb-0">
                                <?= $jml_total; ?>
                            </h4>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-single-copy-04 text-light text-lg opacity-10"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Proses -->
        <div class="col-xl-3 col-sm-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Sedang Diproses</p>
                            <h4 class="font-weight-bolder mb-0">
                                <?= $jml_proses; ?>
                            </h4>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                <i class="ni ni-time-alarm text-light text-lg opacity-10"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Selesai -->
        <div class="col-xl-3 col-sm-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Pengaduan Selesai</p>
                            <h4 class="font-weight-bolder mb-0">
                                <?= $jml_selesai; ?>
                            </h4>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                <i class="ni ni-check-bold text-light text-lg opacity-10"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ditolak -->
        <div class="col-xl-3 col-sm-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Pengaduan Ditolak</p>
                            <h4 class="font-weight-bolder mb-0">
                                <?= $jml_tolak; ?>
                            </h4>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                <i class="ni ni-fat-remove text-light text-lg opacity-10"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 🚫 Tidak ada tombol aksi di bawah lagi -->
</div>