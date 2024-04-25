<?php
$koneksi = new mysqli ("localhost","root","","db_jwd");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
echo "Koneksi berhasil";
mysqli_close($koneksi);
?>
?>