<?php
session_start();
include '../layouts/header.php';

// ini program untuk menendang user NAKAL
if (!isset($_SESSION['login']) || $_SESSION['login'] != "masyarakat") {
    header("Location:../index.php?page=login");
    exit;
}

// kalau nggak ada ?page, pakai 'dashboard' sebagai default
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

switch ($page) {
    case 'dashboard':      // DASHBOARD MASYARAKAT
        include 'dashboard.php';
        break;

    case 'home':           // FORM PENGADUAN
        include 'home.php';
        break;

    case 'aduan':          // DAFTAR PENGADUAN
        include 'aduan.php';
        break;

    case 'tanggapan':      // (kalau nanti dipakai)
        include 'tanggapan.php';
        break;

    default:
        // kalau page nggak dikenal, balik lagi ke dashboard
        include 'dashboard.php';
        break;
}

include '../layouts/footer.php';
?>
