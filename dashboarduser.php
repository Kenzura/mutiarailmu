<?php
    include 'indexuser.php';
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
                <div class="row mt-4">
                    <div class="col-md-12">
                        <h4 class="font-weight-bold mb-4">Langkah-Langkah Pendaftaran</h4>
         <div class="row">
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="fas fa-smile text-warning" style="font-size: 1.5rem;"></i><br>
                <i class="fas fa-user-plus text-primary mt-2" style="font-size: 2.5rem;"></i>
                <h5 class="mt-3">Membuat Akun</h5>
                <p class="text-muted">Buat akun baru untuk memulai proses pendaftaran ekstrakurikuler</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="fas fa-pen text-success" style="font-size: 1.5rem;"></i><br>
                <i class="fas fa-user-edit text-success mt-2" style="font-size: 2.5rem;"></i>
                <h5 class="mt-3">Isi Data Diri</h5>
                <p class="text-muted">Lengkapi informasi pribadi dan data yang diperlukan untuk pendaftaran</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="fas fa-check-circle text-warning" style="font-size: 1.5rem;"></i><br>
                <i class="fas fa-tasks text-warning mt-2" style="font-size: 2.5rem;"></i>
                <h5 class="mt-3">Memilih Ekstrakurikuler</h5>
                <p class="text-muted">Pilih kegiatan ekstrakurikuler yang ingin diikuti</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="fas fa-hourglass-half text-danger" style="font-size: 1.5rem;"></i><br>
                <i class="fas fa-clock text-danger mt-2" style="font-size: 2.5rem;"></i>
                <h5 class="mt-3">Menunggu Pengumuman</h5>
                <p class="text-muted">Tunggu hasil seleksi dan pengumuman penerimaan</p>
            </div>
        </div>
    </div>
</div>


                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <img src="assets/images/user.svg" style="width: 100%; max-width: 600px;" alt="Ekstrakurikuler Seru di Sekolah">
                    </div>
                    <div class="col-md-6">
                        <h4 class="font-weight-bold">Temukan Ekskul yang Cocok untuk Kamu!</h4>
                        <p class="text-muted">
                            Sekolah kami menawarkan berbagai ekstrakurikuler menarik untuk mengembangkan bakat dan minatmu. Ingin tahu pilihannya?
                        </p>
                        <div class="mb-3">
                            <h5 class="font-weight-bold">Pilihan Ekskul Unggulan:</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><span class="badge badge-success mr-2">1</span> <strong>ART MEDIA</strong> - Kembangkan kreativitasmu di dunia desain dan multimedia</li>
                                <li class="mb-2"><span class="badge badge-success mr-2">2</span> <strong>ENGLISH CLUB</strong> - Tingkatkan kemampuan bahasa Inggris dengan cara menyenangkan</li>
                                <li class="mb-2"><span class="badge badge-success mr-2">3</span> <strong>FUTSAL</strong> - Bergabunglah dengan tim futsal sekolah yang berprestasi</li>
                                <li class="mb-2"><span class="badge badge-success mr-2">4</span> <strong>PASKIBRA</strong> - Latih kedisiplinan dan kebanggaan nasional</li>
                                <li class="mb-2"><span class="badge badge-success mr-2">5</span> <strong>PMR</strong> - Belajar pertolongan pertama dan jadi relawan kesehatan</li>
                                <li class="mb-2"><span class="badge badge-success mr-2">6</span> <strong>PRAMUKA</strong> - Asah kemandirian dan jiwa kepemimpinan</li>
                                <li class="mb-2"><span class="badge badge-success mr-2">7</span> <strong>SANGGAR SENI</strong> - Ekspresikan diri melalui tari, musik, dan teater</li>
                                <li class="mb-2"><span class="badge badge-success mr-2">8</span> <strong>TAKRAW</strong> - Olahraga tradisional yang menantang dan seru</li>
                            </ul>
                        </div>
                        <p class="text-muted">
                            Cara daftar mudah: Pilih ekskul favoritmu, klik tombol daftar, dan tunggu konfirmasi. Kamu bisa memantau status pendaftaran di profilmu kapan saja.
                        </p>
                        <a href="daftar_ekskul.php" class="btn btn-success text-white">
                           Yuk, Daftar Sekarang!
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.card {
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0,0,0,0.2);
}
</style>