<?php

include "../config/koneksi.php";

//untuk hapus pengaduan
if (isset($_POST['hapus_pengaduan'])) {
    //menampung data dari id_pengaduan
    $id_pengaduan = mysqli_real_escape_string($conn, $_POST["id_pengaduan"]);

    //sintaks sql untuk mengambil data dari pengaduan
    $query = mysqli_query($conn, "SELECT * FROM pengaduan WHERE id_pengaduan = '$id_pengaduan'");

    // Cek Jika Data tidak kosong
    if ($query && mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_array($query);

        // Hapus Gambar
        if (is_file("../database/img/" . $data['foto'])) {
            unlink("../database/img/" . $data['foto']);
        }

        // Hapus data yg id_pengaduan = $id_pengaduan
        mysqli_query($conn, "DELETE FROM pengaduan WHERE id_pengaduan = '$id_pengaduan'");
        mysqli_query($conn, "DELETE FROM tanggapan WHERE id_pengaduan = '$id_pengaduan'");
        echo "<script>
                 alert('Data Berhasil di Hapus');
                document.location.href='index.php?page=pengaduan';
            </script>";
    } else {
        echo "<script>
                 alert('Data Gagal di HAPUS');
                document.location.href='index.php?page=pengaduan';
            </script>";
    }
}

//untuk hapus Tanggapan
if (isset($_POST['hapus_tanggapan'])) {
    $id_tanggapan = mysqli_real_escape_string($conn, $_POST["id_tanggapan"]);
    $id_pengaduan = mysqli_real_escape_string($conn, $_POST["id_pengaduan"]);

    // ambil data pengaduan untuk hapus foto
    $q_pengaduan = mysqli_query($conn, "SELECT * FROM pengaduan WHERE id_pengaduan = '$id_pengaduan'");
    if ($q_pengaduan && mysqli_num_rows($q_pengaduan) > 0) {
        $dp = mysqli_fetch_assoc($q_pengaduan);
        if (!empty($dp['foto']) && is_file("../database/img/" . $dp['foto'])) {
            unlink("../database/img/" . $dp['foto']);
        }
    }

    $h_tanggapan = mysqli_query($conn, "DELETE FROM tanggapan WHERE id_tanggapan = '$id_tanggapan'");
    $h_pengaduan = mysqli_query($conn, "DELETE FROM pengaduan WHERE id_pengaduan = '$id_pengaduan'");

    if ($h_tanggapan && $h_pengaduan) {
        echo "<script>
                 alert('Data Berhasil dihapus');
                 document.location.href='index.php?page=tanggapan';
              </script>";
    } else {
        echo "<script>
                 alert('Data Gagal dihapus');
                 document.location.href='index.php?page=tanggapan';
              </script>";
    }
}


// untuk hapus Petugas
if (isset($_POST['hapus_petugas'])) {
    $id_petugas = mysqli_real_escape_string($conn, $_POST["id_petugas"]);

    // 1. Cek apakah petugas ini sudah pernah dipakai di tabel tanggapan
    $cek_relasi = mysqli_query($conn, "SELECT 1 FROM tanggapan WHERE id_petugas = '$id_petugas' LIMIT 1");

    if ($cek_relasi && mysqli_num_rows($cek_relasi) > 0) {
        // ada tanggapan yang pakai petugas ini -> jangan hapus
        echo "<script>
                alert('Data petugas tidak dapat dihapus karena sudah dipakai pada data tanggapan.');
                document.location.href='index.php?page=petugas';
              </script>";
        exit;
    }

    // 2. Kalau tidak dipakai, baru boleh hapus
    $delete = mysqli_query($conn, "DELETE FROM petugas WHERE id_petugas = '$id_petugas'");

    if ($delete && mysqli_affected_rows($conn) > 0) {
        echo "<script>
                alert('Data petugas berhasil dihapus.');
                document.location.href='index.php?page=petugas';
              </script>";
    } else {
        // tampilkan pesan gagal + error mysql buat debugging
        $err = mysqli_error($conn);
        echo "<script>
                alert('Data petugas gagal dihapus. Error: " . addslashes($err) . "');
                document.location.href='index.php?page=petugas';
              </script>";
    }
}


//untuk hapus masyarakat
if (isset($_POST['hapus_masyarakat'])) {
    //menampung data dari nik
    $nik = mysqli_real_escape_string($conn, $_POST["nik"]);

    //sintaks sql untuk menghapus data masyarakat
    $delete = mysqli_query($conn, "DELETE FROM masyarakat WHERE nik = '$nik'");
    if ($delete) {
        echo "<script>
                 alert('Data Berhasil di Hapus');
                document.location.href='index.php?page=masyarakat';
            </script>";
    } else {
        echo "<script>
                 alert('Data Gagal di HAPUS');
                document.location.href='index.php?page=masyarakat';
            </script>";
    }
}
