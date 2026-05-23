<?php
include 'koneksi.php';

if (isset($_POST['hapus'])) {
    $id = $_POST['id'];

    $query = mysqli_query($conn, "DELETE FROM admin_ekskul WHERE id_admin='$id'");

    if ($query) {
        echo "<script>alert('Admin berhasil dihapus!'); window.location.href='admin.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus admin.'); window.location.href='admin.php';</script>";
    }
}
?>
