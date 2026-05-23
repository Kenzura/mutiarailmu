<?php 
    include 'indexekskul.php';
    $id_ekskul = $_SESSION['id_ekskul'];
    $per_page = 10;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start = ($page-1) * $per_page;

    $status_condition = "AND (
        (p.ekskul_1 = '$id_ekskul' AND p.status_ekskul_1 IN ('pending', 'ditolak')) OR 
        (p.ekskul_2 = '$id_ekskul' AND p.status_ekskul_2 IN ('pending', 'ditolak'))
    )";

    $cek_status = mysqli_query($conn, "SELECT status, link_group FROM ekskul WHERE id_ekskul = '$id_ekskul'");
    $data_status = mysqli_fetch_assoc($cek_status);
    $status_ekskul = $data_status['status'];
    $link_ekskul = $data_status['link_group'];
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row align-items-center mb-3">
            <div class="col-md-6">
                <form action="tambahlinkgroup.php" method="POST" class="d-flex gap-2">
                    <div class="input-group">
                    <input type="url" name="link_wa" class="form-control" placeholder="Masukkan link grup WA" value="<?= !empty($link_ekskul) ? htmlspecialchars($link_ekskul) : '' ?>" required>
                        <input type="hidden" name="id_ekskul" value="<?= $id_ekskul ?>">
                        <button class="btn btn-success text-white" type="submit" name="simpan">Simpan</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-end">
                <form action="editstatusekskul.php" method="POST">
                    <input type="hidden" name="id_ekskul" value="<?= $id_ekskul ?>">
                    <button type="submit" name="ubah_status" class="btn btn-outline-<?= $status_ekskul == 'aktif' ? 'danger' : 'success' ?>">
                        <?= $status_ekskul == 'aktif' ? 'Tutup Pendaftaran' : 'Buka Pendaftaran' ?>
                    </button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Pendaftar</h4>
                        <div class="table-responsive pt-3">
                            <table class="table table-striped" id="tabelPendaftar">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>NIS</th>
                                        <th>Nama Siswa</th>
                                        <th>Alasan Pendaftaran</th> 
                                        <th>Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = mysqli_query($conn, "
                                        SELECT p.*, d.nama_lengkap, d.nis, d.kelas, d.jenis_kelamin, d.alamat, d.no_hp, d.foto
                                        FROM pendaftaran p
                                        JOIN data_diri d ON p.id = d.id
                                        WHERE (p.ekskul_1 = '$id_ekskul' OR p.ekskul_2 = '$id_ekskul') 
                                        $status_condition
                                        LIMIT $start, $per_page");
                                        
                                        $no = $start + 1;

                                        if (mysqli_num_rows($query) == 0) {
                                            echo '<tr><td colspan="6" class="text-center text-muted">Tidak ada data pendaftar dengan status pending/ditolak.</td></tr>';
                                        } else {
                                            while ($data = mysqli_fetch_array($query)) {
                                                $status = '';
                                                if ($data['ekskul_1'] == $id_ekskul) {
                                                    $status = $data['status_ekskul_1'];
                                                    $alasan = $data['alasan_1'];
                                                } elseif ($data['ekskul_2'] == $id_ekskul) {
                                                    $status = $data['status_ekskul_2'];
                                                    $alasan = $data['alasan_2'];
                                                }
                                                
                                                $status_badge = 'warning';
                                                if ($status == 'ditolak') {
                                                    $status_badge = 'danger';
                                                }
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td><?= $data['nis']; ?></td>
                                        <td><?= $data['nama_lengkap']; ?></td>
                                        <td><?= htmlspecialchars($alasan ?? '-'); ?></td>
                                        <td><span class="badge bg-<?= $status_badge ?>"><?= ucfirst($status); ?></span></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusModal<?= $data['id_pendaftaran']; ?>">
    <i class="fas fa-trash-alt text-white fa-lg"></i>
</button>

                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#infoModal<?= $data['id_pendaftaran']; ?>">
                                                <i class="fas fa-info-circle text-white fa-lg"></i>
                                            </button>
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#konfirmasiModal<?= $data['id_pendaftaran']; ?>">
                                                <i class="fas fa-check-circle text-white fa-lg"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="hapusModal<?= $data['id_pendaftaran']; ?>" tabindex="-1">
    <div class="modal-dialog">
        <form action="hapuspendaftar.php" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close btn-close-white" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
<input type="hidden" name="id_pendaftaran" value="<?= $data['id_pendaftaran']; ?>">
<input type="hidden" name="id_ekskul" value="<?= $id_ekskul; ?>">

                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Apakah Anda yakin ingin menghapus pendaftar <strong><?= htmlspecialchars($data['nama_lengkap']) ?></strong>? Data ini tidak dapat dikembalikan.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger text-white" name="hapus">Hapus</button>
                </div>
            </div>
        </form>
    </div>
</div>

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
                                                            <div class="mb-3">
                                                                <label class="fw-bold">Alasan Memilih Ekskul Ini</label>
                                                                <p><?= nl2br(htmlspecialchars($alasan ?? '-')) ?></p>
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
                                    <div class="modal fade" id="konfirmasiModal<?= $data['id_pendaftaran']; ?>" tabindex="-1">
                                        <div class="modal-dialog">
                                            <form action="konfirmasipendaftar.php" method="POST">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Konfirmasi Status Pendaftaran</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id_pendaftaran" value="<?= $data['id_pendaftaran']; ?>">
                                                        <input type="hidden" name="id_ekskul" value="<?= $id_ekskul; ?>">
                                                        <div class="alert alert-danger mb-4">
                                                            <i class="fas fa-info-circle me-2"></i>
                                                            Silakan tentukan status pendaftaran untuk siswa ini. Pastikan Anda telah memverifikasi semua persyaratan sebelum menentukan status.
                                                        </div>
                                                        <div class="mb-3">
                                                                <label class="fw-bold">Alasan Memilih Ekskul Ini</label>
                                                                <p><?= nl2br(htmlspecialchars($alasan ?? '-')) ?></p>
                                                            </div>
                                                        <div class="form-group mb-3">
                                                            <label class="fw-bold mb-2">Status Pendaftaran</label>
                                                            <select name="status" class="form-select" required>
                                                                <option value="" disabled selected>-- Pilih Status Pendaftaran --</option>
                                                                <option value="diterima" class="text-success">Diterima - Siswa memenuhi semua persyaratan</option>
                                                                <option value="ditolak" class="text-danger">Ditolak - Siswa tidak memenuhi persyaratan</option>
                                                            </select>
                                                            <small class="text-muted">Status ini akan menentukan kelanjutan proses pendaftaran siswa</small>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-success text-white" name="konfirmasi">Konfirmasi Status</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <?php } } ?>
                                </tbody>
                            </table>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination pagination-sm justify-content-center">
                                            <?php
                                            $total_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM pendaftaran p JOIN data_diri d ON p.id = d.id WHERE (p.ekskul_1 = '$id_ekskul' OR p.ekskul_2 = '$id_ekskul') $status_condition");
                                            $total_data = mysqli_fetch_assoc($total_query)['total'];
                                            $total_pages = ceil($total_data / $per_page);

                                            if($page > 1) {
                                                echo '<li class="page-item"><a class="page-link bg-success text-white" href="?page='.($page-1).'">Previous</a></li>';
                                            }

                                            for($i = 1; $i <= $total_pages; $i++) {
                                                $active = ($i == $page) ? 'active' : '';
                                                echo '<li class="page-item '.$active.'"><a class="page-link '.($active ? 'bg-success text-white' : 'text-success').'" href="?page='.$i.'">'.$i.'</a></li>';
                                            }

                                            if($page < $total_pages) {
                                                echo '<li class="page-item"><a class="page-link bg-success text-white" href="?page='.($page+1).'">Next</a></li>';
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
        <div class="text-end">
            <a href="cetaklaporanpendaftar.php?id_ekskul=<?= $id_ekskul ?>" target="_blank" class="btn btn-success text-white"><i class="fas fa-print"></i> Cetak</a>
        </div>
    </div> 
</div>