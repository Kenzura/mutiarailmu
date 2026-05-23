<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $id_user = $_POST['id_user'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $nis = $_POST['nis'];
    $kelas = $_POST['kelas'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];

    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    $folder = "assets/images/siswa/";

    $cek_nis = mysqli_query($conn, "SELECT * FROM data_diri WHERE nis = '$nis'");
    if (mysqli_num_rows($cek_nis) > 0) {
        echo "<script>alert('NIS sudah terdaftar, silakan gunakan NIS yang berbeda.'); window.history.back();</script>";
        exit;
    }

    if (!empty($foto)) {
        $foto_baru = uniqid() . "_" . $foto;
        $upload = move_uploaded_file($tmp, $folder . $foto_baru);
    } else {
        $foto_baru = 'blankuser.jpg';
    }

    $insert = mysqli_query($conn, "INSERT INTO data_diri (
        id, nama_lengkap, nis, kelas, jenis_kelamin, alamat, no_hp, foto
    ) VALUES (
        '$id_user', '$nama_lengkap', '$nis', '$kelas', '$jenis_kelamin', '$alamat', '$no_hp', '$foto_baru'
    )");

    if ($insert) {
        echo "<script>alert('Data berhasil disimpan'); window.location.href='daftardatadiri.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Akses tidak sah!'); window.location.href='daftardatadiri.php';</script>";
}
