<?php
    include 'koneksi.php';
    session_start();
    
    if (!isset($_SESSION['id'])) {
        header("Location: login.php");
        exit;
    }
    
    $id_user = isset($_GET['id']) ? $_GET['id'] : $_SESSION['id'];
    
    $query_user = mysqli_query($conn, "SELECT * FROM data_diri WHERE id = '$id_user'");
    $user_data = mysqli_fetch_assoc($query_user);
    
    $query_pendaftaran = mysqli_query($conn, "SELECT * FROM pendaftaran WHERE id = '$id_user'");
    $pendaftaran_data = mysqli_fetch_assoc($query_pendaftaran);

    $ekskul_1_data = null;
    if ($pendaftaran_data && $pendaftaran_data['ekskul_1']) {
        $query_ekskul_1 = mysqli_query($conn, "SELECT nama_ekskul FROM ekskul WHERE id_ekskul = '" . $pendaftaran_data['ekskul_1'] . "'");
        $ekskul_1_data = mysqli_fetch_assoc($query_ekskul_1);
    }
    
    $ekskul_2_data = null;
    if ($pendaftaran_data && $pendaftaran_data['ekskul_2']) {
        $query_ekskul_2 = mysqli_query($conn, "SELECT nama_ekskul FROM ekskul WHERE id_ekskul = '" . $pendaftaran_data['ekskul_2'] . "'");
        $ekskul_2_data = mysqli_fetch_assoc($query_ekskul_2);
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pendaftaran Ekstrakurikuler</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #ddd;
            padding: 15px;
        }
        h2, h4 {
            margin-top: 10px;
        }
        .header {
            text-align: center;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .profile {
            display: flex;
            margin-bottom: 20px;
        }
        .photo {
            width: 180px;
            height: 240px;
            border: 1px solid #ddd;
            margin-right: 20px;
        }
        .photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .details {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 240px;
        }
        .profile-row {
            margin-bottom: 10px;
            padding: 10px 0;
        }
        .label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            font-size: 16px;
        }
        .value {
            font-size: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .status-diterima {
            color: green;
        }
        .status-ditolak {
            color: red;
        }
        .status-pending {
            color: orange;
        }
        .pernyataan {
            margin-bottom: 20px;
        }
        .ttd {
            text-align: right;
            margin-top: 40px;
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container">
        <div class="header">
            <h2>Bukti Pendaftaran Ekstrakurikuler</h2>
        </div>
        
        <div class="profile">
            <div class="photo">
            <?php
                $foto = (!empty($user_data['foto'])) ? 'assets/images/siswa/' . $user_data['foto'] : 'assets/images/blankuser.jpg';
            ?>
            <img src="<?= $foto ?>" alt="Foto Profil">
            </div>
            <div class="details">
                <div class="profile-row">
                    <span class="label">NIS</span>
                    <span class="value"><?= $user_data['nis']; ?></span>
                </div>
                <div class="profile-row">
                    <span class="label">Nama Siswa</span>
                    <span class="value"><?= $user_data['nama_lengkap']; ?></span>
                </div>
                <div class="profile-row">
                    <span class="label">Kelas</span>
                    <span class="value"><?= $user_data['kelas']; ?></span>
                </div>
            </div>
        </div>
        
        <h4>Pilihan Ekstrakurikuler</h4>
        <table>
            <tr>
                <th>Pilihan 1</th>
                <th>Pilihan 2</th>
            </tr>
            <tr>
                <td>
                    <?php if ($ekskul_1_data): ?>
                        <?= $ekskul_1_data['nama_ekskul'] ?><br>
                        <span class="status-<?= strtolower($pendaftaran_data['status_ekskul_1'] ?? 'pending') ?>">
                            <?php 
                            $status = $pendaftaran_data['status_ekskul_1'] ?? 'pending';
                            echo ucfirst($status == 'diterima' ? 'Diterima' : ($status == 'ditolak' ? 'Ditolak' : 'Menunggu'));
                            ?>
                        </span>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ($ekskul_2_data): ?>
                        <?= $ekskul_2_data['nama_ekskul'] ?><br>
                        <span class="status-<?= strtolower($pendaftaran_data['status_ekskul_2'] ?? 'pending') ?>">
                            <?php 
                            $status = $pendaftaran_data['status_ekskul_2'] ?? 'pending';
                            echo ucfirst($status == 'diterima' ? 'Diterima' : ($status == 'ditolak' ? 'Ditolak' : 'Menunggu'));
                            ?>
                        </span>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
            </tr>
        </table>
        
        <div class="pernyataan">
            <h4>Pernyataan</h4>
            <p>
                Dengan ini saya menyatakan komitmen untuk mengikuti kegiatan ekstrakurikuler yang telah saya pilih dengan 
                penuh tanggung jawab dan dedikasi. Saya berjanji untuk aktif berpartisipasi dalam setiap pertemuan, 
                mematuhi peraturan yang berlaku, dan berkontribusi secara positif untuk kemajuan dan prestasi ekstrakurikuler.
            </p>
            <p>
                Saya juga menyadari bahwa kegiatan ekstrakurikuler yang saya ikuti akan membantu saya membangun 
                jaringan pertemanan yang lebih luas, mengasah kemampuan bekerja dalam tim, dan memperkaya pengalaman 
                pendidikan saya di sekolah.
            </p>
        </div>
        
        <div class="ttd">
            <p>
                ________________________, <?= date('d F Y') ?><br><br>
                <br><br><br><br>
                
                <u><?= $user_data['nama_lengkap'] ?? 'Pendaftar' ?></u>
            </p>
        </div>
    </div>
</body>
</html>