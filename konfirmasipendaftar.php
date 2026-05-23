<?php
include 'koneksi.php';

if (isset($_POST['konfirmasi'])) {
    $id_pendaftaran = $_POST['id_pendaftaran'];
    $id_ekskul = $_POST['id_ekskul'];
    $status = $_POST['status'];

    $query = mysqli_query($conn, "SELECT * FROM pendaftaran WHERE id_pendaftaran = '$id_pendaftaran'");
    $data = mysqli_fetch_assoc($query);

    if ($data['ekskul_1'] == $id_ekskul) {
        $update = mysqli_query($conn, "UPDATE pendaftaran SET status_ekskul_1 = '$status' WHERE id_pendaftaran = '$id_pendaftaran'");
    } elseif ($data['ekskul_2'] == $id_ekskul) {
        $update = mysqli_query($conn, "UPDATE pendaftaran SET status_ekskul_2 = '$status' WHERE id_pendaftaran = '$id_pendaftaran'");
    } else {
        $update = false;
    }

    if ($update) {
        echo "<script>alert('Konfirmasi berhasil dilakukan'); window.location.href='pendaftar.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data'); window.history.back();</script>";
    }
} else {
    header("Location: pendaftar.php");
}
?>
