<?php
include 'koneksi.php';

if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $keterangan = $_POST['keterangan'];
    $status = 'aktif';

    $query = mysqli_query($conn, "INSERT INTO ekskul (nama_ekskul, status) VALUES ('$nama', '$status')");

    if ($query) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='ekskul.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data.'); window.location.href='ekskul.php';</script>";
    }
}
?>
