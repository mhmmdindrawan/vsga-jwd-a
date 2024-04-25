<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Table with Bootstrap</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        form {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.html">Beranda</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pemesanan.html">Objek Wisata</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Fasilitas Wisata
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pemesanan.html">Paket Wisata</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="tampil_pemesanan.php">Pemesanan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pemesanan.html">Gallery</a>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
<div class="card card-success">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-user"></i>Data Pemesanan</h3>
		</h3>
		<div class="card-tools">
		</div>
	</div>
    <div class="grid gap-3 mt-3">
    <?php
// Tambahkan kode untuk menampilkan pemberitahuan
if (isset($_GET['pesan']) && $_GET['pesan'] == "hapus_berhasil") {
    echo '<div class="alert alert-success" role="alert">
            Data berhasil dihapus.
          </div>';
}
?>

        <a href="tambah_pemesanan.php" class="btn btn-primary ml-5 mb-3">Tambah Data</a>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Jumlah Peserta</th>
                    <th>Waktu Perjalanan</th>
                    <th>Paket</th>
                    <th class="mr-2 ml-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // Koneksi ke database
            $koneksi = new mysqli("localhost", "root", "", "db_jwd");

            // Fungsi untuk mendapatkan semua data
            function semuaData() {
                global $koneksi;
                $sql = "SELECT * FROM tbl_pemesanan";
                $result = $koneksi->query($sql);
                return $result->fetch_all(MYSQLI_ASSOC);
            } 

            $data = semuaData();
            $nomor = 1; // variabel untuk nomor urutan
            foreach ($data as $row) {
                echo "<tr>";
                echo "<td>" . $nomor++ . "</td>"; // Menampilkan nomor urutan dan kemudian meningkatkan nilainya
                echo "<td>" . $row['nama'] . "</td>";
                echo "<td>" . $row['jumlah_peserta'] . "</td>";
                echo "<td>" . $row['waktu_perjalanan'] . "</td>";
                echo "<td>" . $row['paket'] . "</td>";
                echo "<td><a href='tampil_pemesanan.php?id=" . $row['id'] . "' class='btn btn-sm btn-info'>Tampil</a> | <a href='edit_pemesanan.php?id=" . $row['id'] . "' class='btn btn-sm btn-warning'>Edit</a> | <a href='hapus_pemesanan.php?id=" . $row['id'] . "' class='btn btn-sm btn-danger'>Hapus</a></td>";
                echo "</tr>";
            }
            ?>

            </tbody>
        </table>
    </div>
</body>
</html>
