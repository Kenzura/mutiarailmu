<?php
session_start();
include "koneksi.php";

$email = $_POST['email'];
$pass = $_POST['pass'];

// Query untuk users dengan password terhash
$login_users = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
$cek_users = mysqli_num_rows($login_users);

// Query untuk admin_ekskul dengan password plain text
$login_admin_ekskul = mysqli_query($conn, "SELECT ae.*, e.nama_ekskul FROM admin_ekskul ae 
                                           JOIN ekskul e ON ae.id_ekskul = e.id_ekskul 
                                           WHERE ae.email='$email' AND ae.password='$pass'");
$cek_admin_ekskul = mysqli_num_rows($login_admin_ekskul);

if($cek_users > 0) {
    $data = mysqli_fetch_assoc($login_users);
    // Verifikasi password untuk users
    if(password_verify($pass, $data['password']) || $pass === $data['password']) {
    if($data['role'] == 'admin') {
        $_SESSION['id'] = $data['id'];
        $_SESSION['nama'] = $data['username'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['role'] = "admin";
        $_SESSION['status'] = "login";
        header("location:dashboard.php");
    } else if($data['role'] == 'users') {
        $id_user = $data['id'];
        $query_data_diri = mysqli_query($conn, "SELECT * FROM data_diri WHERE id='$id_user'");
        $data_diri = mysqli_fetch_assoc($query_data_diri);

        $_SESSION['id'] = $data['id'];
        $_SESSION['nama'] = $data['username'];
        $_SESSION['email'] = $data['email'];
        
        if(mysqli_num_rows($query_data_diri) > 0) {
            $_SESSION['nama_lengkap'] = $data_diri['nama_lengkap'];
            $_SESSION['nis'] = $data_diri['nis'];
            $_SESSION['kelas'] = $data_diri['kelas'];
        }
        
        $_SESSION['role'] = "users";
        $_SESSION['status'] = "login";
        header("location:dashboarduser.php");
    } else {
        echo '<script>alert("Akun tidak memiliki akses yang valid");window.location="login.php"</script>';
        }
    } else {
        echo '<script>alert("Username atau Password salah");window.location="login.php"</script>';
    }
} else if($cek_admin_ekskul > 0) {
    $data = mysqli_fetch_assoc($login_admin_ekskul);
    
    $_SESSION['id_admin'] = $data['id_admin'];
    $_SESSION['nama'] = $data['username'];
    $_SESSION['email'] = $data['email'];
    $_SESSION['id_ekskul'] = $data['id_ekskul'];
    $_SESSION['nama_ekskul'] = $data['nama_ekskul'];
    $_SESSION['role'] = "admin_ekskul";
    $_SESSION['status'] = "login";
    header("location:dashboardekskul.php");
} else {
    echo '<script>alert("Username atau Password salah");window.location="login.php"</script>';
}
?>