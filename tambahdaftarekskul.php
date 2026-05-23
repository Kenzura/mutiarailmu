<?php
include 'koneksi.php';

$ekskul_1 = $_POST['ekskul_1'];
$ekskul_2 = !empty($_POST['ekskul_2']) ? $_POST['ekskul_2'] : null;
$alasan_1 = $_POST['alasan_1'];
$alasan_2 = !empty($_POST['ekskul_2']) ? $_POST['alasan_2'] : null;
$id_user = $_POST['id_user'];

// Validasi ekskul tidak boleh sama
if ($ekskul_2 !== null && $ekskul_1 === $ekskul_2) {
    echo "<script>alert('Ekskul tidak boleh sama!'); window.location.href='daftarekskul.php';</script>";
    exit();
}

$cek = mysqli_query($conn, "SELECT * FROM pendaftaran WHERE id = '$id_user'");

if (mysqli_num_rows($cek) > 0) {
    $update = mysqli_query($conn, "
        UPDATE pendaftaran SET 
            ekskul_1 = '$ekskul_1',
            ekskul_2 = " . ($ekskul_2 === null ? "NULL" : "'$ekskul_2'") . ",
            status_ekskul_1 = 'pending',
            status_ekskul_2 = " . ($ekskul_2 === null ? "NULL" : "'pending'") . ",
            alasan_1 = '$alasan_1',
            alasan_2 = " . ($ekskul_2 === null ? "NULL" : "'$alasan_2'") . "
        WHERE id = '$id_user'
    ");

    if ($update) {
        echo "<script>alert('Pendaftaran berhasil diperbarui!'); window.location.href='daftarpendaftaran.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui pendaftaran.'); window.location.href='daftarekskul.php';</script>";
    }

} else {
    $insert = mysqli_query($conn, "
        INSERT INTO pendaftaran 
            (id, ekskul_1, ekskul_2, status_ekskul_1, status_ekskul_2, alasan_1, alasan_2) 
        VALUES 
            ('$id_user', '$ekskul_1', " . ($ekskul_2 === null ? "NULL" : "'$ekskul_2'") . ", 'pending', " . ($ekskul_2 === null ? "NULL" : "'pending'") . ", '$alasan_1', " . ($ekskul_2 === null ? "NULL" : "'$alasan_2'") . ")
    ");

    if ($insert) {
        echo "<script>alert('Pendaftaran berhasil!'); window.location.href='daftarpendaftaran.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan pendaftaran.'); window.location.href='daftarekskul.php';</script>";
    }
}
?>
