<?php
    include 'koneksi.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';

    $mail = new PHPMailer(true);

    if (isset($_POST['tambah'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $id_ekskul = $_POST['id_ekskul'];

        $password = rand(1000000, 9999999);

        $query_ekskul = mysqli_query($conn, "SELECT nama_ekskul FROM ekskul WHERE id_ekskul='$id_ekskul'");
        $data_ekskul = mysqli_fetch_assoc($query_ekskul);
        $nama_ekskul = $data_ekskul['nama_ekskul'];

        $query = mysqli_query($conn, "INSERT INTO admin_ekskul (username, email, password, id_ekskul) VALUES ('$username', '$email', '$password', '$id_ekskul')");

        if ($query) {
            $mail = new PHPMailer(true);
            try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
            $mail->isSMTP();                                      
            $mail->Host       = 'smtp.gmail.com';    
            $mail->SMTPAuth   = true;          
            $mail->Username   = 'coba101121@gmail.com';           
            $mail->Password   = 'avwy ehwy ggrv bekp';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;


            $mail->setFrom('from@cobaweb.com', 'Ekskul Mutil');
            $mail->addAddress($email, $username);

            $mail->isHTML(true);
            $mail->Subject = 'Ekstrakulikuler Mutil - Admin';
            $mail->Body = '<b>Halo... </b>' . $username . '
            <br> <b>Email = </b>' . $email . ' <br> <b>Password = </b>' . $password. '
            <br> Anda Telah Didaftarkan Di Ekskul Mutil Sebagai Admin untuk ekstrakulikuler <b>' . $nama_ekskul . '</b>
            <br><br>Silahkan login menggunakan kredensial di atas.
            <br>Untuk keamanan, segera ubah password Anda setelah login pertama kali.';

                $mail->send();
                echo '<script>alert("Berhasil Tambah Data dan Email Terkirim!");window.location="admin.php"</script>';
            } catch (Exception $e) {
                echo '<script>alert("Berhasil Tambah Data, gagal mengirim email. Error: ' . $mail->ErrorInfo . '");window.location="admin.php"</script>';
            }
        } else {
            echo '<script>alert("Gagal Tambah Data!");window.location="admin.php"</script>';
        }
    }
?>