<?php
include 'index.php';

$ukmQuery = "SELECT COUNT(*) as total_ekskul FROM ekskul";
$ukmResult = mysqli_query($conn, $ukmQuery);
$ukmRow = mysqli_fetch_assoc($ukmResult);
$totalEKskul = $ukmRow['total_ekskul'];

$driverQuery = "SELECT COUNT(*) as total_admin FROM admin_ekskul";
$driverResult = mysqli_query($conn, $driverQuery);
$driverRow = mysqli_fetch_assoc($driverResult);
$totalAdmin = $driverRow['total_admin'];

$userQuery = "SELECT COUNT(*) as total_user FROM users WHERE role = 'users'";
$userResult = mysqli_query($conn, $userQuery);
$userRow = mysqli_fetch_assoc($userResult);
$totalUser = $userRow['total_user'];

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
                                            <p class="mb-4 text-white">Total Ekskul</p>
                                            <p class="fs-30 mb-2 text-white"><?= $totalEKskul; ?></p>
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
                                            <p class="mb-4 text-white">Total Admin</p>
                                            <p class="fs-30 mb-2 text-white"><?= $totalAdmin; ?></p>
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
                                            <p class="mb-4 text-white">Total Pengguna</p>
                                            <p class="fs-30 mb-2 text-white"><?= $totalUser; ?></p>
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