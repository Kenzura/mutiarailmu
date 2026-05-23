<?php
include 'koneksi.php';

if (isset($_POST['edit'])) {
    $id_user = $_POST['id_user'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $nis = $_POST['nis'];
    $kelas = $_POST['kelas'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $nohp = $_POST['no_hp'];

    // Cek apakah NIS sudah digunakan oleh user lain
    $cek_nis = mysqli_query($conn, "SELECT * FROM data_diri WHERE nis = '$nis' AND id != '$id_user'");
    if (mysqli_num_rows($cek_nis) > 0) {
        echo "<script>alert('NIS sudah digunakan oleh pengguna lain, silakan gunakan NIS yang berbeda.'); window.history.back();</script>";
        exit;
    }

    $getData = mysqli_query($conn, "SELECT foto FROM data_diri WHERE id = '$id_user'");
    $dataLama = mysqli_fetch_assoc($getData);
    $fotoLama = $dataLama['foto'];

    if ($_FILES['foto']['name'] != "") {
        $fotoBaru = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        $folder = "assets/images/siswa/";

        if (!empty($fotoLama) && file_exists($folder . $fotoLama) && $fotoLama != 'blankuser.jpg') {
            unlink($folder . $fotoLama);
        }
        move_uploaded_file($tmp, $folder . $fotoBaru);
    } else {
        $fotoBaru = $fotoLama;
    }

    $update = mysqli_query($conn, "UPDATE data_diri SET 
        nama_lengkap = '$nama_lengkap',
        nis = '$nis',
        kelas = '$kelas',
        jenis_kelamin = '$jenis_kelamin',
        alamat = '$alamat',
        no_hp = '$nohp',
        foto = '$fotoBaru'
        WHERE id = '$id_user'
    ");

    if ($update) {
        echo "<script>alert('Data berhasil diperbarui'); window.location.href='daftardatadiri.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Akses tidak sah!'); window.location.href='daftardatadiri.php';</script>";
}
