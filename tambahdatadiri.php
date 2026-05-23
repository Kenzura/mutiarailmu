<?php
include 'koneksi.php';
session_start();

if (isset($_POST['tambah'])) {
    $id_user = $_SESSION['id_user'];
    $nama = $_POST['nama_lengkap'];
    $nis = $_POST['nis'];
    $kelas = $_POST['kelas'];
    $jk = $_POST['jenis_kelamin'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];

    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    $size = $_FILES['foto']['size'];
    $ext = strtolower(pathinfo($foto, PATHINFO_EXTENSION));
    $allowed_ext = ['jpg', 'jpeg', 'png'];

    $new_filename = uniqid() . '.' . $ext;
    $upload_path = 'assets/images/siswa/' . $new_filename;

    if (move_uploaded_file($tmp, $upload_path)) {
        $query = "INSERT INTO data_diri (id, nama_lengkap, nis, kelas, jenis_kelamin, no_hp, alamat, foto)
                  VALUES ('$id_user', '$nama', '$nis', '$kelas', '$jk', '$no_hp', '$alamat', '$new_filename')";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Data diri berhasil disimpan!'); window.location='dashboarduser.php';</script>";
        } else {
            echo "<script>alert('Gagal menyimpan data: " . mysqli_error($conn) . "'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Gagal mengupload foto'); window.history.back();</script>";
    }
} else {
    header("Location: datadiri.php");
}
?>
