<?php
include 'koneksi.php';

if (!isset($_GET['id_ekskul'])) {
    die("ID Ekstrakurikuler tidak ditemukan");
}

$id_ekskul = $_GET['id_ekskul'];

$query_ekskul = mysqli_query($conn, "SELECT nama_ekskul FROM ekskul WHERE id_ekskul = '$id_ekskul'");
if (mysqli_num_rows($query_ekskul) == 0) {
    die("Ekstrakurikuler tidak ditemukan");
}
$ekskul_name = mysqli_fetch_assoc($query_ekskul)['nama_ekskul'];

// Query modified to only show pending status
$print_query = mysqli_query($conn, "
    SELECT p.*, d.*,
        CASE 
            WHEN p.ekskul_1 = '$id_ekskul' THEN p.status_ekskul_1
            WHEN p.ekskul_2 = '$id_ekskul' THEN p.status_ekskul_2
        END as status_pendaftaran
    FROM pendaftaran p
    JOIN data_diri d ON p.id = d.id
    WHERE (p.ekskul_1 = '$id_ekskul' OR p.ekskul_2 = '$id_ekskul')
    AND (
        (p.ekskul_1 = '$id_ekskul' AND p.status_ekskul_1 IN ('pending', 'ditolak')) OR 
        (p.ekskul_2 = '$id_ekskul' AND p.status_ekskul_2 IN ('pending', 'ditolak'))
    )
    ORDER BY d.nama_lengkap ASC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pendaftar Pending <?= $ekskul_name ?></title>
    <link rel="shortcut icon" href="assets/images/logo1.png" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .school-header {
            font-size: 16px;
            margin-bottom: 5px;
        }
        h1 {
            font-size: 20px;
            margin: 10px 0;
        }
        h2 {
            font-size: 18px;
            margin: 5px 0 20px;
            color: #e67e22;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .pending {
            color: #e67e22;
            font-weight: bold;
        }

        @media print {
            body {
                margin: 0;
                padding: 15px;
            }
            button {
                display: none;
            }
            .pending {
                color: #000 !important;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="header">
        <p class="school-header">SMK MUTIARA ILMU MAKASSAR</p>
        <h1>LAPORAN DATA PENDAFTAR EKSTRAKURIKULER</h1>
        <p>Tanggal Cetak: <?= date('d-m-Y') ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">NIS</th>
                <th width="40%">Nama Siswa</th>
                <th width="15%">Kelas</th>
                <th width="25%">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($print_query) == 0) {
                echo '<tr><td colspan="5" style="text-align: center;">Tidak ada pendaftar</td></tr>';
            } else {
                $no = 1;
                while ($data = mysqli_fetch_array($print_query)) {
            ?>
            <tr>
                <td style="text-align: center;"><?= $no++ ?></td>
                <td><?= $data['nis'] ?></td>
                <td><?= $data['nama_lengkap'] ?></td>
                <td><?= $data['kelas'] ?></td>
                <td class="pending"><?= ucfirst($data['status_pendaftaran']) ?></td>
            </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</body>
</html>