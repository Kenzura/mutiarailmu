<?php 
    include 'index.php'; 
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Pengguna</h4>
                        <div class="table-responsive pt-3">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        include 'koneksi.php';
                                        $query = mysqli_query($conn, "
                                            SELECT users.*, data_diri.nama_lengkap, data_diri.nis, data_diri.kelas,
                                                    data_diri.alamat, data_diri.jenis_kelamin, data_diri.no_hp
                                            FROM users
                                            LEFT JOIN data_diri ON users.id = data_diri.id
                                            WHERE users.role = 'users'
                                            ");

                                        $no = 1;
                                        while ($user = mysqli_fetch_array($query)) {
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td><?= $user['username']; ?></td>
                                            <td><?= $user['email']; ?></td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#infoUserModal<?= $user['id']; ?>">
                                                    <i class="fas fa-circle-info text-white fa-lg"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusUserModal<?= $user['id']; ?>">
                                                    <i class="fas fa-trash text-white fa-lg"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="infoUserModal<?= $user['id']; ?>" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Informasi Pengguna</h5>
                                                    <button type="button" class="btn-close" data-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Nama Lengkap:</strong> <?= $user['nama_lengkap'] ?? '-'; ?></p>
                                                    <p><strong>NIS:</strong> <?= $user['nis'] ?? '-'; ?></p>
                                                    <p><strong>Kelas:</strong> <?= $user['kelas'] ?? '-'; ?></p>
                                                    <p><strong>Alamat:</strong> <?= $user['alamat'] ?? '-'; ?></p>
                                                    <p><strong>Jenis Kelamin:</strong> <?= $user['jenis_kelamin'] ?? '-'; ?></p>
                                                    <p><strong>No. HP:</strong> <?= $user['no_hp'] ?? '-'; ?></p>
                                                    <p><strong>Username:</strong> <?= $user['username']; ?></p>
                                                    <p><strong>Email:</strong> <?= $user['email']; ?></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="hapusUserModal<?= $user['id']; ?>" tabindex="-1">
                                            <div class="modal-dialog">
                                                <form action="hapuspengguna.php" method="POST">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Hapus Pengguna</h5>
                                                            <button type="button" class="btn-close" data-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="text-center">Yakin ingin menghapus pengguna ini?</p>
                                                            <input type="hidden" name="id" value="<?= $user['id']; ?>">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                                                            <button type="submit" name="hapus" class="btn btn-danger text-white">Hapus</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
