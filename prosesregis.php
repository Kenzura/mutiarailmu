<?php
    session_start();
    include 'koneksi.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';

    if (isset($_POST['regis'])) {
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $role = 'users';

        // Cek email duplikat
        $check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
        if(mysqli_num_rows($check_email) > 0) {
            echo "<script>
                alert('Peringatan! Email sudah terdaftar dalam sistem!');
                window.location.href = 'login.php';
            </script>";
            exit();
        }

        $pass_asli = $pass;
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $query = mysqli_query($conn, "INSERT INTO users (username, email, password, role) 
                    VALUES ('$nama', '$email', '$pass', '$role')");

        if ($query) {
            $mail = new PHPMailer(true);
            try {
                $mail->SMTPDebug = SMTP::DEBUG_OFF;
                $mail->isSMTP();                                      
                $mail->Host       = 'smtp.gmail.com';    
                $mail->SMTPAuth   = true;          
                $mail->Username   = 'coba101121@gmail.com';           
                $mail->Password   = 'avwy ehwy ggrv bekp';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port       = 465;

                $mail->setFrom('from@cobaweb.com', 'Ekskul Mutil');
                $mail->addAddress($email, $nama);

                $mail->isHTML(true);
                $mail->Subject = 'Ekstrakulikuler Mutil - Users';
                $mail->Body = '<b>Halo... </b>' . $nama . '
                <br> <b>Email = </b>' . $email . ' <br> <b>Password = </b>' . $pass_asli. '
                <br> Anda Telah mendaftar Di Ekskul Mutil</b>
                <br><br>Silahkan login menggunakan kredensial di atas.
                <br>Untuk keamanan, segera ubah password Anda setelah login pertama kali.';

                $mail->send();
                echo "<script>
                    alert('Berhasil! Akun berhasil dibuat dan email telah terkirim!');
                    window.location.href = 'login.php';
                </script>";
            } catch (Exception $e) {
                $error_msg = $mail->ErrorInfo;
                echo "<script>
                    alert('Perhatian! Akun berhasil dibuat, tetapi gagal mengirim email. Error: " . $error_msg . "');
                    window.location.href = 'login.php';
                </script>";
            }
        } else {
            echo "<script>
                alert('Gagal! Tidak dapat menambahkan data!');
                window.location.href = 'login.php';
            </script>";
        }
    }
?>