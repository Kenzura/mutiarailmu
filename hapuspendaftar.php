<?php
include 'koneksi.php';

if (isset($_POST['hapus'])) {
    $id_pendaftaran = $_POST['id_pendaftaran'];
    $id_ekskul = $_POST['id_ekskul'];
    
    // Hapus dari tabel pendaftaran
    $update = mysqli_query($conn, "
    UPDATE pendaftaran 
    SET 
        ekskul_1 = CASE WHEN ekskul_1 = '$id_ekskul' THEN 0 ELSE ekskul_1 END,
        ekskul_2 = CASE WHEN ekskul_2 = '$id_ekskul' THEN 0 ELSE ekskul_2 END,
        status_ekskul_1 = CASE WHEN ekskul_1 = '$id_ekskul' THEN 'pending' ELSE status_ekskul_1 END,
        status_ekskul_2 = CASE WHEN ekskul_2 = '$id_ekskul' THEN 'pending' ELSE status_ekskul_2 END,
        alasan_1 = CASE WHEN ekskul_1 = '$id_ekskul' THEN NULL ELSE alasan_1 END,
        alasan_2 = CASE WHEN ekskul_2 = '$id_ekskul' THEN NULL ELSE alasan_2 END
    WHERE id_pendaftaran = '$id_pendaftaran'
    ");

    if ($update) {
        // Jika berhasil update, hapus baris jika kedua ekskul kosong
        $check = mysqli_query($conn, "SELECT ekskul_1, ekskul_2 FROM pendaftaran WHERE id_pendaftaran = '$id_pendaftaran'");
        $data = mysqli_fetch_assoc($check);
        
        if ($data['ekskul_1'] == 0 && $data['ekskul_2'] == 0) {
            mysqli_query($conn, "DELETE FROM pendaftaran WHERE id_pendaftaran = '$id_pendaftaran'");
        }
        
        echo "<script>alert('Pendaftar berhasil dihapus'); window.location.href='pendaftar.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus pendaftar'); window.history.back();</script>";
    }
} else {
    header("Location: pendaftar.php");
}
?>