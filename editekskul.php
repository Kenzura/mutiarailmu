<?php
include 'koneksi.php';

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];

    $query = mysqli_query($conn, "UPDATE ekskul SET nama_ekskul='$nama' WHERE id_ekskul='$id'");

    if ($query) {
        echo "<script>alert('Data berhasil diupdate!'); window.location.href='ekskul.php';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate data.'); window.location.href='ekskul.php';</script>";
    }
}
?>
