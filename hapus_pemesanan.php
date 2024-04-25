<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "db_jwd");

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Periksa apakah parameter id telah diterima melalui URL
if (isset($_GET['id'])) {
    // Ambil nilai id dari URL
    $id = $_GET['id'];

    // Check if the user confirmed the deletion
    if (isset($_GET['confirm']) && $_GET['confirm'] == 'true') {
        // Query SQL untuk menghapus data berdasarkan id
        $sql = "DELETE FROM tbl_pemesanan WHERE id = $id";

        // Jalankan query
        if ($koneksi->query($sql) === TRUE) {
            // Redirect kembali ke halaman tampil_pemesanan.php setelah menghapus data
            header("Location: data_pemesanan.php?pesan=hapus_berhasil");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $koneksi->error;
        }
    } else {
        // Show confirmation dialog if the user hasn't confirmed deletion
        echo '<script>
            var confirmDelete = confirm("Apakah Anda yakin ingin menghapus data?");
            if (confirmDelete) {
                window.location.href = "hapus_pemesanan.php?id=' . $id . '&confirm=true";
            } else {
                window.location.href = "data_pemesanan.php";
            }
        </script>';
    }
}

// Tutup koneksi
$koneksi->close();
?>
