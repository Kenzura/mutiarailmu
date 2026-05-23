<?php 
    include 'index.php'; 
?>
<div class="main-panel">
    <div class="content-wrapper">
        <button type="button" class="btn btn-success text-white mb-3" data-toggle="modal" data-target="#tambahAdminModal">
            Tambah
        </button>
        <div class="row">
            <div class="col grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Admin</h4>
                        <div class="table-responsive pt-3">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Ekstrakulikuler</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        include 'koneksi.php';
                                        $query = mysqli_query($conn, "SELECT admin_ekskul.*, ekskul.nama_ekskul FROM admin_ekskul LEFT JOIN ekskul ON admin_ekskul.id_ekskul = ekskul.id_ekskul");
                                        $no = 1;
                                        while ($admin = mysqli_fetch_array($query)) {
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td><?= $admin['username']; ?></td>
                                            <td><?= $admin['email']; ?></td>
                                            <td><?= $admin['nama_ekskul']; ?></td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editAdminModal<?= $admin['id_admin']; ?>">
                                                    <i class="fas fa-pen-to-square text-white fa-lg"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusAdminModal<?= $admin['id_admin']; ?>">
                                                    <i class="fas fa-trash text-white fa-lg"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="editAdminModal<?= $admin['id_admin']; ?>" tabindex="-1">
                                            <div class="modal-dialog">
                                                <form action="editadmin.php" method="POST">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Admin</h5>
                                                            <button type="button" class="btn-close" data-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id" value="<?= $admin['id_admin']; ?>">
                                                            <div class="form-group">
                                                                <label>Username</label>
                                                                <input type="text" class="form-control" name="username" value="<?= $admin['username']; ?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input type="email" class="form-control" name="email" value="<?= $admin['email']; ?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Ekskul</label>
                                                                <select name="id_ekskul" class="form-select" required>
                                                                    <option selected-disabled>-- Pilih Ekskul --</option>
                                                                    <?php
                                                                    $ekskul = mysqli_query($conn, "SELECT * FROM ekskul");
                                                                    while ($e = mysqli_fetch_array($ekskul)) {
                                                                        $selected = ($e['id_ekskul'] == $admin['id_ekskul']) ? "selected" : "";
                                                                        echo "<option value='$e[id_ekskul]' $selected>$e[nama_ekskul]</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                                                            <button type="submit" name="edit" class="btn btn-success text-white">Simpan</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="hapusAdminModal<?= $admin['id_admin']; ?>" tabindex="-1">
                                            <div class="modal-dialog">
                                                <form action="hapusadmin.php" method="POST">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Hapus Admin</h5>
                                                            <button type="button" class="btn-close" data-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="text-center">Yakin ingin menghapus admin ini?</p>
                                                            <input type="hidden" name="id" value="<?= $admin['id_admin']; ?>">
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
        <div class="modal fade" id="tambahAdminModal" tabindex="-1">
            <div class="modal-dialog">
                <form action="tambahadmin.php" method="POST">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Admin</h5>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Ekskul</label>
                                <select name="id_ekskul" class="form-select" required>
                                    <option selected disabled>-- Pilih Ekskul --</option>
                                    <?php
                                    $ekskul = mysqli_query($conn, "SELECT * FROM ekskul");
                                    while ($e = mysqli_fetch_array($ekskul)) {
                                        $selected = ($e['id_ekskul'] == $admin['id_ekskul']) ? "selected" : "";
                                        echo "<option value='$e[id_ekskul]' $selected>$e[nama_ekskul]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                            <button type="submit" name="tambah" class="btn btn-success text-white">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
