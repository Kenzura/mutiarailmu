<?php
    include 'indexuser.php';
    $id_user = $_SESSION['id'];
    $query = mysqli_query($conn, "
        SELECT data_diri.*, users.email 
        FROM data_diri 
        JOIN users ON data_diri.id = users.id 
        WHERE data_diri.id = '$id_user'
    ");
    $data = mysqli_fetch_assoc($query);
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="card-title mb-0">Data Diri</h4>
                            <?php if ($data) { ?>
                                <button class="btn btn-warning btn-sm text-white" data-toggle="modal" data-target="#editDataDiriModal">
                                    <i class="fas fa-edit"></i> Update
                                </button>
                            <?php } else { ?>
                                <button class="btn btn-success text-white btn-sm" data-toggle="modal" data-target="#isiDataDiriModal">
                                    <i class="fas fa-plus"></i> Isi Data Diri
                                </button>
                            <?php } ?>
                        </div>

                        <?php if ($data) { ?>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <?php
                                        $foto = (!empty($data['foto'])) ? 'assets/images/siswa/' . $data['foto'] : 'assets/images/blankuser.jpg';
                                    ?>
                                    <img src="<?= $foto ?>" alt="Foto Profil" class="img-fluid mb-3" style="width: 264px; height: 314px; object-fit: cover; border-radius: 5px;">
                                    <div class="kontak-section">
                                        <h5 class="mb-3">Kontak</h5>
                                        <div class="form-group mb-3">
                                            <label>Email</label>
                                            <input type="email" class="form-control bg-light" value="<?= isset($data['email']) ? $data['email'] : '-'; ?>" readonly>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label>Nomor HP</label>
                                            <input type="number" class="form-control bg-light" value="<?= $data['no_hp']; ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="biodata-section">
                                        <h5 class="mb-3">Biodata</h5>
                                        <div class="form-group mb-3">
                                            <label>Nama Lengkap</label>
                                            <input type="text" class="form-control bg-light" value="<?= $data['nama_lengkap']; ?>" readonly>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label>NIS</label>
                                            <input type="number" class="form-control bg-light" value="<?= $data['nis']; ?>" readonly>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label>Kelas</label>
                                            <input type="text" class="form-control bg-light" value="<?= $data['kelas']; ?>" readonly>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label>Jenis Kelamin</label>
                                            <input type="text" class="form-control bg-light" value="<?= $data['jenis_kelamin']; ?>" readonly>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label>Alamat</label>
                                            <textarea class="form-control bg-light" rows="3" readonly><?= $data['alamat']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="text-center my-5">
                                <p class="text-muted mb-3">Anda belum mengisi data diri.</p>
                                <button class="btn btn-success text-white" data-toggle="modal" data-target="#isiDataDiriModal">
                                    <i class="fas fa-plus"></i> Isi Data Diri Sekarang
                                </button>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="isiDataDiriModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="tmbhdatadiri.php" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Isi Data Diri</h5>
                    <button type="button" class="btn-close" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_user" value="<?= $id_user; ?>">
                    <div class="row">
                        <div class="col-md-3 text-center mb-3">
                            <?php
                                $foto = (!empty($data['foto'])) ? 'assets/images/siswa/' . $data['foto'] : 'assets/images/blankuser.jpg';
                            ?>
                            <img src="<?= $foto ?>" alt="Foto Profil" class="img-fluid mb-3" style="width: 264px; height: 314px; object-fit: cover; border-radius: 5px;">
                            <div class="mt-2">
                                <div class="form-group">
                                    <input type="file" name="foto" class="form-control" style="font-size: 12px;" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <h5 class="mb-3">Biodata</h5>
                            <div class="form-group mb-3">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label>NIS</label>
                                <input type="number" name="nis" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label>Kelas</label>
                                <input type="text" name="kelas" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label>Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select" required>
                                    <option value="">Pilih</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>Alamat</label>
                                <textarea name="alamat" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label>No HP</label>
                                <input type="number" name="no_hp" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                    <button type="submit" name="simpan" class="btn btn-success text-white">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="editDataDiriModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="editdatadiri.php" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Diri</h5>
                    <button type="button" class="btn-close" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_user" value="<?= $id_user; ?>">
                    <div class="row">
                        <div class="col-md-3 text-center mb-3">
                            <?php
                                $foto = (!empty($data['foto'])) ? 'assets/images/siswa/' . $data['foto'] : 'assets/images/blankuser.jpg';
                            ?>
                            <img src="<?= $foto ?>" alt="Foto Profil" class="img-fluid mb-3" style="width: 264px; height: 314px; object-fit: cover; border-radius: 5px;">
                            <div class="mt-2">
                                <div class="form-group">
                                    <input type="file" name="foto" class="form-control" style="font-size: 12px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <h5 class="mb-3">Biodata</h5>
                            <div class="form-group mb-3">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control" value="<?= $data['nama_lengkap']; ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label>NIS</label>
                                <input type="number" name="nis" class="form-control" value="<?= $data['nis']; ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label>Kelas</label>
                                <input type="text" name="kelas" class="form-control" value="<?= $data['kelas']; ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label>Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select" required>
                                    <option value="Laki-laki" <?= $data['jenis_kelamin'] == 'Laki-laki' ? 'selected' : ''; ?>>Laki-laki</option>
                                    <option value="Perempuan" <?= $data['jenis_kelamin'] == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>Alamat</label>
                                <textarea name="alamat" class="form-control" rows="3" required><?= $data['alamat']; ?></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label>No HP</label>
                                <input type="number" name="no_hp" class="form-control" value="<?= $data['no_hp']; ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                    <button type="submit" name="edit" class="btn btn-warning text-white">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>