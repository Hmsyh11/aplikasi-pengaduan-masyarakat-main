<?php
include "../config/koneksi.php";

//////////////////////////////
// HAPUS PENGADUAN (masyarakat)
//////////////////////////////
if (isset($_POST["hapus_pengaduan"])) {
    // menampung id_pengaduan
    $id_pengaduan = mysqli_real_escape_string($conn, $_POST["id_pengaduan"]);

    // ambil data pengaduan
    $h_pengaduan = mysqli_query($conn, "SELECT * FROM pengaduan WHERE id_pengaduan = '$id_pengaduan'");
    $cek = mysqli_num_rows($h_pengaduan);

    if ($cek > 0) {
        $data = mysqli_fetch_assoc($h_pengaduan);

        // hapus file foto jika ada
        if (!empty($data['foto']) && is_file("../database/img/" . $data['foto'])) {
            unlink("../database/img/" . $data['foto']);
        }

        // hapus data di tabel pengaduan
        mysqli_query($conn, "DELETE FROM pengaduan WHERE id_pengaduan = '$id_pengaduan'");

        // hapus juga di tabel tanggapan (kalau ada)
        mysqli_query($conn, "DELETE FROM tanggapan WHERE id_pengaduan = '$id_pengaduan'");

        echo "<script>
                alert('Data Berhasil dihapus');
                document.location.href='index.php?page=aduan';
              </script>";
    } else {
        echo "<script>
                alert('Data Gagal dihapus (data tidak ditemukan)');
                document.location.href='index.php?page=aduan';
              </script>";
    }
}

//////////////////////////////
// EDIT PENGADUAN (masyarakat)
//////////////////////////////
if (isset($_POST["edit_pengaduan"])) {

    $id_pengaduan    = mysqli_real_escape_string($conn, $_POST["id_pengaduan"]);
    $judul_pengaduan = mysqli_real_escape_string($conn, $_POST["judul_pengaduan"]);
    $isi_laporan     = mysqli_real_escape_string($conn, $_POST["isi_laporan"]);

    // foto lama dikirim dari form (hidden)
    $foto_lama = isset($_POST["foto_lama"]) ? $_POST["foto_lama"] : "";

    // data file upload foto baru (kalau ada)
    $nama_foto_baru = isset($_FILES["foto"]["name"]) ? $_FILES["foto"]["name"] : "";
    $tmp_foto_baru  = isset($_FILES["foto"]["tmp_name"]) ? $_FILES["foto"]["tmp_name"] : "";

    // default pakai foto lama
    $nama_foto_final = $foto_lama;

    // jika user memilih foto baru
    if (!empty($nama_foto_baru)) {

        // hapus foto lama kalau ada
        if (!empty($foto_lama) && is_file("../database/img/" . $foto_lama)) {
            unlink("../database/img/" . $foto_lama);
        }

        // buat nama file baru biar unik
        $ext = pathinfo($nama_foto_baru, PATHINFO_EXTENSION);
        $nama_baru = "pengaduan_" . time() . "." . $ext;

        // upload ke folder tujuan
        if (move_uploaded_file($tmp_foto_baru, "../database/img/" . $nama_baru)) {
            $nama_foto_final = $nama_baru;
        } else {
            echo "<script>
                    alert('Upload foto gagal');
                    document.location.href='index.php?page=aduan';
                  </script>";
            exit;
        }
    }

    // update hanya field yang boleh diubah oleh masyarakat
    $query = "UPDATE pengaduan SET 
                judul_pengaduan = '$judul_pengaduan',
                isi_laporan     = '$isi_laporan',
                foto            = '$nama_foto_final'
              WHERE id_pengaduan = '$id_pengaduan'";

    $update = mysqli_query($conn, $query);

    if ($update) {
        echo "<script>
                alert('Data pengaduan berhasil diubah');
                document.location.href='index.php?page=aduan';
              </script>";
    } else {
        echo "<script>
                alert('Data pengaduan gagal diubah');
                document.location.href='index.php?page=aduan';
              </script>";
    }
}
?>
