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

// Fungsi untuk menyimpan perubahan data pemesanan
function simpanPerubahan($id, $nama, $jumlah_peserta, $waktu_perjalanan, $paket, $harga_paket) {
    // Lakukan koneksi ke database
    $koneksi = new mysqli("localhost", "root", "", "db_jwd");

    // Periksa koneksi
    if ($koneksi->connect_error) {
        die("Koneksi gagal: " . $koneksi->connect_error);
    }

    // Query SQL untuk mengupdate data pemesanan
    $sql = "UPDATE tbl_pemesanan SET nama='$nama', jumlah_peserta=$jumlah_peserta, waktu_perjalanan='$waktu_perjalanan', paket='$paket', harga_paket='$harga_paket' WHERE id=$id";

    // Jalankan query
    if ($koneksi->query($sql) === TRUE) {
        // Jika data berhasil diperbarui, redirect ke halaman tampil_pemesanan.php
        header("Location: data_pemesanan.php?edit_success=true");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }

    // Tutup koneksi
    $koneksi->close();
}

// Jika form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $jumlah_peserta = $_POST["jumlah_peserta"];
    $waktu_perjalanan = $_POST["waktu_perjalanan"];
    $paket = $_POST["paket"];
    $harga_paket = $_POST["harga_paket"];

    // Panggil fungsi simpanPerubahan untuk menyimpan perubahan data pemesanan
    simpanPerubahan($id, $nama, $jumlah_peserta, $waktu_perjalanan, $paket, $harga_paket);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Edit Data</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Edit Data Pemesanan</h2>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $pemesanan['id']; ?>">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $pemesanan['nama']; ?>">
            </div>
            <div class="form-group">
                <label for="jumlah_peserta">Jumlah Peserta:</label>
                <input type="number" class="form-control" id="jumlah_peserta" name="jumlah_peserta" value="<?php echo $pemesanan['jumlah_peserta']; ?>">
            </div>
            <div class="form-group">
                <label for="waktu_perjalanan">Waktu Perjalanan:</label>
                <input type="text" class="form-control" id="waktu_perjalanan" name="waktu_perjalanan" value="<?php echo $pemesanan['waktu_perjalanan']; ?>">
            </div>
            <div class="form-group">
            <select class="form-control" id="paket" name="paket">
                <option value="Paket A">Paket A</option>
                <option value="Paket B">Paket B</option>
                <option value="Paket C">Paket C</option>
            </select>

            </div>
            <div class="card-footer">
                <input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
                <a href="data_pemesanan.php" title="Kembali" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>
