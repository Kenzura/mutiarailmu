<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $id_ekskul = $_POST['id_ekskul'];
    $link_wa = $_POST['link_wa'];

    $update = mysqli_query($conn, "UPDATE ekskul SET link_group = '$link_wa' WHERE id_ekskul = '$id_ekskul'");

    if ($update) {
         echo "<script>alert('Link berhasil ditambahkan'); window.location.href='pendaftar.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data'); window.history.back();</script>";
    }
}
?>
