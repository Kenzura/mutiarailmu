<?php
include 'koneksi.php';

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $id_ekskul = $_POST['id_ekskul'];

    $query = mysqli_query($conn, "UPDATE admin_ekskul SET username='$username', email='$email', id_ekskul='$id_ekskul' WHERE id_admin='$id'");

    if ($query) {
        echo "<script>alert('Admin berhasil diperbarui!'); window.location.href='admin.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui admin.'); window.location.href='admin.php';</script>";
    }
}
?>
