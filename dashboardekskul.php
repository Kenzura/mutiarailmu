<?php
include 'indexekskul.php';
$id_ekskul = $_SESSION['id_ekskul'];

$queryTotal = "SELECT COUNT(*) as total FROM pendaftaran 
               WHERE ekskul_1 = '$id_ekskul' OR ekskul_2 = '$id_ekskul'";
$resultTotal = mysqli_query($conn, $queryTotal);
$rowTotal = mysqli_fetch_assoc($resultTotal);
$totalPendaftar = $rowTotal['total'];

$queryDiterima = "SELECT COUNT(*) as total FROM pendaftaran 
                  WHERE (ekskul_1 = '$id_ekskul' AND status_ekskul_1 = 'diterima') 
                     OR (ekskul_2 = '$id_ekskul' AND status_ekskul_2 = 'diterima')";
$resultDiterima = mysqli_query($conn, $queryDiterima);
$rowDiterima = mysqli_fetch_assoc($resultDiterima);
$totalDiterima = $rowDiterima['total'];

$queryDitolak = "SELECT COUNT(*) as total FROM pendaftaran 
                 WHERE (ekskul_1 = '$id_ekskul' AND status_ekskul_1 = 'ditolak') 
                    OR (ekskul_2 = '$id_ekskul' AND status_ekskul_2 = 'ditolak')";
$resultDitolak = mysqli_query($conn, $queryDitolak);
$rowDitolak = mysqli_fetch_assoc($resultDitolak);
$totalDitolak = $rowDitolak['total'];
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Selamat Datang, <?php echo $_SESSION['nama']; ?>!</h3>
                        <h6 class="font-weight-normal mb-0">Ekstrakulikuler Mutiara Ilmu</span></h6>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <button class="btn btn-sm btn-light bg-white" type="button" id="dropdownMenuDate2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="mdi mdi-calendar"></i> <?= date('Y-m-d'); ?> 
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center p-4">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-4 mb-4 stretch-card transparent">
                                <div class="card bg-success">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <p class="mb-4 text-white">Total Pedaftar</p>
                                            <p class="fs-30 mb-2 text-white"><?= $totalPendaftar; ?></p>
                                        </div>
                                        <div>
                                            <i class="fas fa-list fa-3x text-light"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4 stretch-card transparent">
                                <div class="card bg-success">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <p class="mb-4 text-white">Pendaftar Ditolak</p>
                                            <p class="fs-30 mb-2 text-white"><?= $totalDiterima; ?></p>
                                        </div>
                                        <div>
                                            <i class="fas fa-user fa-4x text-light"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4 stretch-card transparent">
                                <div class="card bg-success">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <p class="mb-4 text-white">Pendaftar Ditolak</p>
                                            <p class="fs-30 mb-2 text-white"><?= $totalDitolak; ?></p>
                                        </div>
                                        <div>
                                            <i class="fas fa-users fa-3x text-light"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>      
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <img src="assets/images/admin.svg" style="width: 100%; max-width: 600px;" alt="Ilustrasi Admin">
                    </div>
                    <div class="col-md-6">
                        <h4 class="font-weight-bold">Tentang Sistem</h4>
                        <p style="font-size: 16px;">
                            Sistem Informasi Ekstrakurikuler ini dirancang untuk mempermudah pengelolaan kegiatan ekstrakurikuler 
                            di lingkungan sekolah. Admin dapat mengatur ekskul dan pengguna, sementara siswa bisa mendaftar dan melihat informasi ekskul dengan mudah.
                        </p>
                        <p style="font-size: 16px;">
                            Dengan tampilan yang intuitif dan data yang real-time, sistem ini diharapkan dapat meningkatkan partisipasi dan koordinasi antara pihak sekolah dan siswa.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>