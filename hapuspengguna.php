<?php
include 'koneksi.php';

if (isset($_POST['hapus'])) {
    $id = $_POST['id'];

    $hapus_data_diri = mysqli_query($conn, "DELETE FROM data_diri WHERE id = '$id'");

    $hapus_user = mysqli_query($conn, "DELETE FROM users WHERE id = '$id'");

    if ($hapus_data_diri && $hapus_user) {
        echo "<script>
            alert('Data pengguna berhasil dihapus.');
            window.location.href='pengguna.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal menghapus data pengguna.');
            window.location.href='pengguna.php';
        </script>";
    }
}
?>
