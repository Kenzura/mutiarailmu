<?php
include 'koneksi.php';

if (isset($_POST['ubah_status'])) {
    $id_ekskul = $_POST['id_ekskul'];

    $cek = mysqli_query($conn, "SELECT status FROM ekskul WHERE id_ekskul = '$id_ekskul'");
    $data = mysqli_fetch_assoc($cek);
    $status = $data['status'];

    $status_baru = ($status == 'aktif') ? 'nonaktif' : 'aktif';

    mysqli_query($conn, "UPDATE ekskul SET status = '$status_baru' WHERE id_ekskul = '$id_ekskul'");
    
    header("Location: pendaftar.php");
}
?>