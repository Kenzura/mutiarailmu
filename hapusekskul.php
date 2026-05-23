<?php
include 'koneksi.php';

if (isset($_POST['hapus'])) {
    $id = $_POST['id'];

    $query = mysqli_query($conn, "DELETE FROM ekskul WHERE id_ekskul='$id'");

    if ($query) {
        echo "<script>alert('Data berhasil dihapus!'); window.location.href='ekskul.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data.'); window.location.href='ekskul.php';</script>";
    }
}
?>
