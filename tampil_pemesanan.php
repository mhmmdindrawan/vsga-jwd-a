<?php
// Fungsi untuk mendapatkan data pemesanan berdasarkan id
function getPemesananById($id) {
    // Lakukan koneksi ke database
    $koneksi = new mysqli("localhost", "root", "", "db_jwd");

    // Periksa koneksi
    if ($koneksi->connect_error) {
        die("Koneksi gagal: " . $koneksi->connect_error);
    }

    // Query SQL untuk mendapatkan data pemesanan berdasarkan id
    $sql = "SELECT * FROM tbl_pemesanan WHERE id = $id";

    // Jalankan query
    $result = $koneksi->query($sql);

    // Periksa apakah data ditemukan
    if ($result->num_rows > 0) {
        // Ambil data sebagai array asosiatif
        $data = $result->fetch_assoc();
        return $data;
    } else {
        echo "Data tidak ditemukan";
        return null;
    }

    // Tutup koneksi
    $koneksi->close();
}

// Periksa apakah parameter id telah diterima melalui URL
if (isset($_GET['id'])) {
    // Ambil nilai id dari URL
    $id = $_GET['id'];

    // Panggil fungsi getPemesananById untuk mendapatkan data pemesanan
    $pemesanan = getPemesananById($id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pemesanan</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Detail Pemesanan</h2>
        <table class="table">
            <tr>
                <td>Nama:</td>
                <td><?php echo $pemesanan['nama']; ?></td>
            </tr>
            <tr>
                <td>Jumlah Peserta:</td>
                <td><?php echo $pemesanan['jumlah_peserta']; ?></td>
            </tr>
            <tr>
                <td>Waktu Perjalanan:</td>
                <td><?php echo $pemesanan['waktu_perjalanan']; ?></td>
            </tr>
            <tr>
                <td>Paket:</td>
                <td><?php echo $pemesanan['paket']; ?></td>
            </tr>
        </table>
        <a href="data_pemesanan.php" class="btn btn-secondary">Kembali</a>
    </div>
</body>
</html>
