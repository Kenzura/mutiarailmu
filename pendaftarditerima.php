<?php 
    include 'indexekskul.php';
    $id_ekskul = $_SESSION['id_ekskul'];
    $per_page = 10;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start = ($page-1) * $per_page;

    // Search parameter
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    $status_condition = "AND (
        (p.ekskul_1 = '$id_ekskul' AND p.status_ekskul_1 = 'diterima') OR 
        (p.ekskul_2 = '$id_ekskul' AND p.status_ekskul_2 = 'diterima')
    )";

    // Search condition
    $search_condition = !empty($search) ? "AND (d.kelas LIKE '%$search%' OR d.nis LIKE '%$search%' OR d.no_hp LIKE '%$search%' OR d.nama_lengkap LIKE '%$search%')" : "";

    $cek_status = mysqli_query($conn, "SELECT status, link_group, nama_ekskul FROM ekskul WHERE id_ekskul = '$id_ekskul'");
    $data_status = mysqli_fetch_assoc($cek_status);
    $status_ekskul = $data_status['status'];
    $link_ekskul = $data_status['link_group'];
    $nama_ekskul = $data_status['nama_ekskul'];

    // Query untuk mendapatkan daftar kelas yang tersedia
    $query_kelas = mysqli_query($conn, "SELECT DISTINCT d.kelas 
                                       FROM pendaftaran p 
                                       JOIN data_diri d ON p.id = d.id 
                                       WHERE (p.ekskul_1 = '$id_ekskul' OR p.ekskul_2 = '$id_ekskul') 
                                       $status_condition 
                                       ORDER BY d.kelas ASC");
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title">Data Pendaftar Diterima - <?= $nama_ekskul ?></h4>
                            <form action="" method="GET" class="d-flex gap-2">
                                <div class="input-group" style="width: 300px;">
                                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama, kelas, NIS, atau nomor HP..." value="<?= htmlspecialchars($search) ?>">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive pt-3">
                            <table class="table table-striped" id="tabelPendaftar">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="5%">No</th>
                                        <th width="15%">NIS</th>
                                        <th width="25%">Nama Siswa</th>
                                        <th width="15%">No HP</th>
                                        <th width="30%">Alamat</th>
                                        <th class="text-center" width="10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = mysqli_query($conn, "
                                        SELECT p.*, d.*
                                        FROM pendaftaran p
                                        JOIN data_diri d ON p.id = d.id
                                        WHERE (p.ekskul_1 = '$id_ekskul' OR p.ekskul_2 = '$id_ekskul') 
                                        $status_condition
                                        $search_condition
                                        ORDER BY d.nama_lengkap ASC
                                        LIMIT $start, $per_page");
                                        
                                        $no = $start + 1;

                                        if (mysqli_num_rows($query) == 0) {
                                            echo '<tr><td colspan="6" class="text-center text-muted">Belum ada pendaftar yang diterima.</td></tr>';
                                        } else {
                                            while ($data = mysqli_fetch_array($query)) {
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td><?= $data['nis']; ?></td>
                                        <td><?= $data['nama_lengkap']; ?></td>
                                        <td><?= $data['no_hp']; ?></td>
                                        <td><?= nl2br(substr(htmlspecialchars($data['alamat']), 0, 100)) . (strlen($data['alamat']) > 100 ? '...' : ''); ?></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#infoModal<?= $data['id_pendaftaran']; ?>">
                                                <i class="fas fa-info-circle text-white"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    
                                    <!-- Modal Info Siswa -->
                                    <div class="modal fade" id="infoModal<?= $data['id_pendaftaran']; ?>" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Info Siswa</h5>
                                                    <button type="button" class="btn-close" data-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-3 text-center mb-3">
                                                            <?php
                                                                $foto = (!empty($data['foto'])) ? 'assets/images/siswa/' . $data['foto'] : 'assets/images/blankuser.jpg';
                                                            ?>
                                                            <img src="<?= $foto ?>" alt="Foto Profil" class="img-fluid mb-3" style="width: 264px; height: 314px; object-fit: cover; border-radius: 5px;">
                                                        </div>
                                                        <div class="col-md-9">
                                                            <h5 class="mb-3">Biodata</h5>
                                                            <div class="mb-3">
                                                                <label class="fw-bold">Nama Lengkap</label>
                                                                <p><?= htmlspecialchars($data['nama_lengkap'] ?? '-') ?></p>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="fw-bold">NIS</label>
                                                                <p><?= htmlspecialchars($data['nis'] ?? '-') ?></p>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="fw-bold">Kelas</label>
                                                                <p><?= htmlspecialchars($data['kelas'] ?? '-') ?></p>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="fw-bold">Jenis Kelamin</label>
                                                                <p><?= htmlspecialchars($data['jenis_kelamin'] ?? '-') ?></p>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="fw-bold">Alamat</label>
                                                                <p><?= nl2br(htmlspecialchars($data['alamat'] ?? '-')) ?></p>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="fw-bold">No HP</label>
                                                                <p><?= htmlspecialchars($data['no_hp'] ?? '-') ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } } ?>
                                </tbody>
                            </table>
                            
                            <!-- Pagination -->
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination pagination-sm justify-content-center">
                                            <?php
                                            $total_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM pendaftaran p JOIN data_diri d ON p.id = d.id WHERE (p.ekskul_1 = '$id_ekskul' OR p.ekskul_2 = '$id_ekskul') $status_condition $search_condition");
                                            $total_data = mysqli_fetch_assoc($total_query)['total'];
                                            $total_pages = ceil($total_data / $per_page);

                                            if($page > 1) {
                                                echo '<li class="page-item"><a class="page-link bg-success text-white" href="?page='.($page-1).'&search='.urlencode($search).'">Previous</a></li>';
                                            }

                                            for($i = 1; $i <= $total_pages; $i++) {
                                                $active = ($i == $page) ? 'active' : '';
                                                echo '<li class="page-item '.$active.'"><a class="page-link '.($active ? 'bg-success text-white' : 'text-success').'" href="?page='.$i.'&search='.urlencode($search).'">'.$i.'</a></li>';
                                            }

                                            if($page < $total_pages) {
                                                echo '<li class="page-item"><a class="page-link bg-success text-white" href="?page='.($page+1).'&search='.urlencode($search).'">Next</a></li>';
                                            }
                                            ?>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <button type="button" class="btn btn-danger text-white" data-toggle="modal" data-target="#resetModal">
                <i class="fas fa-redo-alt"></i> Reset Pendaftar
            </button>
            <a href="cetaklaporanpendaftarditerima.php?id_ekskul=<?= $id_ekskul ?>" target="_blank" class="btn btn-success text-white ms-2">
                <i class="fas fa-print"></i> Cetak
            </a>
        </div>
    </div> 
</div>
<div class="modal fade" id="resetModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="resetpendaftaran.php" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reset Data Pendaftar</h5>
                    <button type="button" class="btn-close btn-close-white" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_ekskul" value="<?= $id_ekskul ?>">
                    <div class="alert alert-warning mb-4">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Peringatan!</strong> Apakah Anda yakin ingin mereset semua data pendaftar yang diterima pada ekstrakurikuler ini? 
                        Tindakan ini akan mengubah status pendaftaran mereka menjadi 'pending' dan memungkinkan mereka mendaftar ulang.
                    </div>
                    <p class="text-center text-danger">
                        <strong>Tindakan ini tidak dapat dibatalkan!</strong>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger text-white" name="reset_pendaftar">Reset Pendaftar</button>
                </div>
            </div>
        </form>
    </div>
</div>