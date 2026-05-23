<?php
    include 'indexuser.php';
    $id_user = $_SESSION['id'];

    $query_user = mysqli_query($conn, "SELECT 
        data_diri.id_data,
        data_diri.id,
        data_diri.nama_lengkap,
        data_diri.nis,
        data_diri.kelas,
        data_diri.alamat,
        data_diri.jenis_kelamin,
        data_diri.no_hp,
        data_diri.foto,
        users.username,
        users.email
    FROM
        data_diri
    INNER JOIN users ON data_diri.id = users.id 
    WHERE data_diri.id = '$id_user'");
    $data_user = mysqli_fetch_assoc($query_user);

    $query_pendaftaran = mysqli_query($conn, "SELECT * FROM pendaftaran WHERE id = '$id_user'");
    $data_pendaftaran = mysqli_fetch_assoc($query_pendaftaran);
    
    $ekskul_1_data = null;
    $ekskul_2_data = null;

    if ($data_pendaftaran && $data_pendaftaran['ekskul_1']) {
        $query_ekskul_1 = mysqli_query($conn, "SELECT e.nama_ekskul, e.link_group AS link_group, p.status_ekskul_1, p.alasan_1 
                                              FROM ekskul e 
                                              JOIN pendaftaran p ON e.id_ekskul = p.ekskul_1 
                                              WHERE p.id = '$id_user' AND e.id_ekskul = '" . $data_pendaftaran['ekskul_1'] . "'");
        $ekskul_1_data = mysqli_fetch_assoc($query_ekskul_1);
    }

    if ($data_pendaftaran && $data_pendaftaran['ekskul_2']) {
        $query_ekskul_2 = mysqli_query($conn, "SELECT e.nama_ekskul, e.link_group AS link_group, p.status_ekskul_2, p.alasan_2 
                                              FROM ekskul e 
                                              JOIN pendaftaran p ON e.id_ekskul = p.ekskul_2 
                                              WHERE p.id = '$id_user' AND e.id_ekskul = '" . $data_pendaftaran['ekskul_2'] . "'");
        $ekskul_2_data = mysqli_fetch_assoc($query_ekskul_2);
    }

    $sudah_daftar = ($data_pendaftaran && ($data_pendaftaran['ekskul_1'] || $data_pendaftaran['ekskul_2']));
?>

<div class="main-panel">
    <div class="content-wrapper">
        <h3 class="card-title mb-4">Status Pendaftaran Ekstrakurikuler</h3>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><strong>Nama</strong></label>
                            <input type="text" class="form-control" value="<?= htmlspecialchars($data_user['nama_lengkap'] ?? '') ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><strong>Kelas</strong></label>
                            <input type="text" class="form-control" value="<?= htmlspecialchars($data_user['kelas'] ?? '') ?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><strong>NIS</strong></label>
                            <input type="text" class="form-control" value="<?= htmlspecialchars($data_user['nis'] ?? '') ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <?php if (!$sudah_daftar): ?>
                            <div class="alert alert-danger">
                                <h4 class="text-center">Anda belum mendaftar ekstrakurikuler</h4>
                                <p class="text-center mt-3">
                                    <a href="daftarekskul.php" class="btn btn-success text-white">Daftar Ekstrakurikuler</a>
                                </p>
                            </div>
                        <?php else: ?>
                            <h4 class="text-center mb-4">DAFTAR EKSTRAKURIKULER YANG DIPILIH</h4>
                            <div class="table-responsive pt-3">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="20%">Nama Ekstrakurikuler</th>
                                            <th width="20%">Status</th>
                                            <th width="30%">Alasan</th>
                                            <th width="25%">Link Group WhatsApp</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($ekskul_1_data): ?>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td><?= $ekskul_1_data['nama_ekskul'] ?></td>
                                                <td>
                                                    <?php if ($ekskul_1_data['status_ekskul_1'] == 'pending'): ?>
                                                        <span class="badge badge-warning">Diproses</span>
                                                    <?php elseif ($ekskul_1_data['status_ekskul_1'] == 'diterima'): ?>
                                                        <span class="badge badge-success">Diterima</span>
                                                    <?php elseif ($ekskul_1_data['status_ekskul_1'] == 'ditolak'): ?>
                                                        <span class="badge badge-danger">Ditolak</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= $ekskul_1_data['alasan_1'] ?? '-' ?></td>
                                                <td>
                                                    <?php if ($ekskul_1_data['status_ekskul_1'] == 'diterima' && $ekskul_1_data['link_group']): ?>
                                                        <a href="<?= $ekskul_1_data['link_group'] ?>" target="_blank" class="btn btn-sm btn-success text-white">
                                                            <i class="fab fa-whatsapp"></i> Gabung Group WhatsApp
                                                        </a>
                                                    <?php elseif ($ekskul_1_data['status_ekskul_1'] == 'pending'): ?>
                                                        <span class="text-muted">Link akan tersedia setelah diterima</span>
                                                    <?php elseif ($ekskul_1_data['status_ekskul_1'] == 'ditolak'): ?>
                                                        <span class="text-danger">Anda tidak dapat bergabung dengan grup ini</span>
                                                    <?php else: ?>
                                                        <span class="text-muted">Link tidak tersedia</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>

                                        <?php if ($ekskul_2_data): ?>
                                            <tr>
                                                <td class="text-center">2</td>
                                                <td><?= $ekskul_2_data['nama_ekskul'] ?></td>
                                                <td>
                                                    <?php if ($ekskul_2_data['status_ekskul_2'] == 'pending'): ?>
                                                        <span class="badge badge-warning">Diproses</span>
                                                    <?php elseif ($ekskul_2_data['status_ekskul_2'] == 'diterima'): ?>
                                                        <span class="badge badge-success">Diterima</span>
                                                    <?php elseif ($ekskul_2_data['status_ekskul_2'] == 'ditolak'): ?>
                                                        <span class="badge badge-danger">Ditolak</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= $ekskul_2_data['alasan_2'] ?? '-' ?></td>
                                                <td>
                                                    <?php if ($ekskul_2_data['status_ekskul_2'] == 'diterima' && $ekskul_2_data['link_group']): ?>
                                                        <a href="<?= $ekskul_2_data['link_group'] ?>" target="_blank" class="btn btn-sm btn-success text-white">
                                                            <i class="fab fa-whatsapp"></i> Gabung Group WhatsApp
                                                        </a>
                                                    <?php elseif ($ekskul_2_data['status_ekskul_2'] == 'pending'): ?>
                                                        <span class="text-muted">Link akan tersedia setelah diterima</span>
                                                    <?php elseif ($ekskul_2_data['status_ekskul_2'] == 'ditolak'): ?>
                                                        <span class="text-danger">Anda tidak dapat bergabung dengan grup ini</span>
                                                    <?php else: ?>
                                                        <span class="text-muted">Link tidak tersedia</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12 text-end">
                                    <a href="cetakbukti.php?id=<?= $id_user ?>" target="_blank" class="btn btn-success text-white">
                                        <i class="fas fa-print"></i> Cetak Bukti Pendaftaran
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
