<?php
// Fungsi untuk menambahkan data ke dalam database
function tambahData($nama, $jumlah_peserta, $waktu_perjalanan, $paket, $harga_paket) {
    // Lakukan koneksi ke database
    $koneksi = new mysqli("localhost", "root", "", "db_jwd");

    // Periksa koneksi
    if ($koneksi->connect_error) {
        die("Koneksi gagal: " . $koneksi->connect_error);
    }

    // Validasi input
    if (empty($nama) || empty($jumlah_peserta) || empty($waktu_perjalanan) || empty($paket) || empty($harga_paket)) {
        echo "<script>alert('Semua field harus diisi');</script>";
        return;
    }    

    // Query SQL untuk menambahkan data
    $sql = "INSERT INTO tbl_pemesanan (nama, jumlah_peserta, waktu_perjalanan, paket, harga_paket) VALUES ('$nama', $jumlah_peserta, '$waktu_perjalanan', '$paket', '$harga_paket')";

    // Jalankan query
    if ($koneksi->query($sql) === TRUE) {
        // Jika data berhasil ditambahkan, redirect ke tampil_pemesanan.php
        header("Location: data_pemesanan.php?success=true");
        exit(); // Pastikan tidak ada output lain sebelum redirect
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }

    // Tutup koneksi
    $koneksi->close();
}

// Jika form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $nama = $_POST["nama"];
    $jumlah_peserta = $_POST["jumlah_peserta"];
    $waktu_perjalanan = $_POST["waktu_perjalanan"];
    $paket = $_POST["paket"];
    $harga_paket = $_POST["harga_paket"];

    // Panggil fungsi tambahData untuk menambahkan data ke database
    tambahData($nama, $jumlah_peserta, $waktu_perjalanan, $paket, $harga_paket);
}
?>


<!DOCTYPE html>
<html lang="en">
<script>
    <?php
    // Tambahkan kode PHP untuk mengecek apakah parameter success bernilai true
    if (isset($_GET['success']) && $_GET['success'] === 'true') {
        echo "alert('Data berhasil disimpan');";
    }
    ?>
</script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah Data</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Tambah Data</h2>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama">
            </div>
            <div class="form-group">
                <label for="jumlah_peserta">Jumlah Peserta:</label>
                <input type="number" class="form-control" id="jumlah_peserta" name="jumlah_peserta" placeholder="Masukkan Jumlah Peserta">
            </div>
            <div class="form-group">
                <label for="waktu_perjalanan">Waktu Perjalanan:</label>
                <input type="text" class="form-control" id="waktu_perjalanan" name="waktu_perjalanan" placeholder="Masukkan Waktu Perjalanan">
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
