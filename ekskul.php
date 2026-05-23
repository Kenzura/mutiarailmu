<?php
    include 'index.php';
?>
<div class="main-panel">
    <div class="content-wrapper">
        <button type="button" class="btn btn-success text-white mb-3" data-toggle="modal" data-target="#tambahEskulModal">
            Tambah
        </button>
        <div class="row">
            <div class="col grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Ekstrakurikuler</h4>
                        <div class="table-responsive pt-3">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Nama</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = mysqli_query($conn, "SELECT * FROM ekskul");
                                        $no = 1;
                                        while ($ekskul = mysqli_fetch_array($query)) {
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $no++; ?></td>
                                        <td><?php echo $ekskul['nama_ekskul']; ?></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editEskulModal<?php echo $ekskul['id_ekskul']; ?>">
                                                <i class="fas fa-pen-to-square text-white fa-lg"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusEskulModal<?php echo $ekskul['id_ekskul']; ?>">
                                                <i class="fas fa-trash text-white fa-lg"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="editEskulModal<?php echo $ekskul['id_ekskul']; ?>" tabindex="-1" role="dialog" aria-labelledby="editEskulModalLabel<?php echo $ekskul['id_ekskul']; ?>" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editEskulModalLabel<?php echo $ekskul['id_ekskul']; ?>">Edit Ekstrakurikuler</h5>
                                                </div>
                                                <form action="editekskul.php" method="POST">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Nama</label>
                                                            <input type="text" class="form-control" name="nama" value="<?php echo $ekskul['nama_ekskul']; ?>" required>
                                                            <input type="hidden" name="id" value="<?php echo $ekskul['id_ekskul']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-warning text-white" name="edit">Edit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="hapusEskulModal<?php echo $ekskul['id_ekskul']; ?>" tabindex="-1" role="dialog" aria-labelledby="hapusEskulModalLabel<?php echo $ekskul['id_ekskul']; ?>" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="hapusEskulModalLabel<?php echo $ekskul['id_ekskul']; ?>">Hapus Ekstrakurikuler</h5>
                                                </div>
                                                <form action="hapusekskul.php" method="POST">
                                                    <div class="modal-body">
                                                        <p class="text-center">Apakah Anda yakin ingin menghapus ekstrakurikuler ini?</p>
                                                        <input type="hidden" name="id" value="<?php echo $ekskul['id_ekskul']; ?>">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-danger text-white" name="hapus">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
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
    <div class="modal fade" id="tambahEskulModal" tabindex="-1" role="dialog" aria-labelledby="tambahEskulModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahEskulModalLabel">Tambah Ekstrakurikuler</h5>
                </div>
                <form action="tambahekskul.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success text-white" name="tambah">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
