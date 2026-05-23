<?php
include 'koneksi.php';

if (isset($_POST['reset_pendaftar'])) {
    $id_ekskul = $_POST['id_ekskul'];

    $query1 = "UPDATE pendaftaran 
               SET status_ekskul_1 = 'pending' 
               WHERE ekskul_1 = '$id_ekskul' AND status_ekskul_1 = 'diterima'";

    $query2 = "UPDATE pendaftaran 
               SET status_ekskul_2 = 'pending' 
               WHERE ekskul_2 = '$id_ekskul' AND status_ekskul_2 = 'diterima'";

    $result1 = mysqli_query($conn, $query1);
    $result2 = mysqli_query($conn, $query2);

    if ($result1 && $result2) {
        echo "<script>
                alert('Data pendaftar berhasil di-reset.');
                window.location.href = 'pendaftarditerima.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal mereset data pendaftar.');
                window.history.back();
              </script>";
    }
} else {
    header("Location: pendaftarditerima.php");
    exit();
}
