<?php
    include 'indexuser.php';
    $id_user = $_SESSION['id'];

    // Cek kelengkapan data diri
    $query_data_diri = mysqli_query($conn, "SELECT * FROM data_diri WHERE id = '$id_user'");
    $data_diri = mysqli_fetch_assoc($query_data_diri);
    $data_diri_lengkap = false;

    if ($data_diri && 
        !empty($data_diri['nama_lengkap']) && 
        !empty($data_diri['nis']) && 
        !empty($data_diri['kelas']) && 
        !empty($data_diri['jenis_kelamin']) && 
        !empty($data_diri['alamat']) && 
        !empty($data_diri['no_hp']) && 
        !empty($data_diri['foto'])) {
        $data_diri_lengkap = true;
    }

    $query_ekskul = mysqli_query($conn, "SELECT * FROM ekskul WHERE status = 'aktif' ORDER BY nama_ekskul ASC");

    $query_all_ekskul = mysqli_query($conn, "SELECT * FROM ekskul ORDER BY nama_ekskul ASC");

    $query_pendaftar = mysqli_query($conn, "SELECT * FROM pendaftaran WHERE id = '$id_user'");
    $data_pendaftar = mysqli_fetch_assoc($query_pendaftar);
    
    $ekskul_1_name = '';
    $ekskul_2_name = '';
    $alasan_1 = '';
    $alasan_2 = '';
    $sudah_daftar = false;

    if ($data_pendaftar && ($data_pendaftar['ekskul_1'] || $data_pendaftar['ekskul_2'])) {
        $sudah_daftar = true;
        
        if ($data_pendaftar['ekskul_1']) {
            $query_ekskul_1 = mysqli_query($conn, "SELECT nama_ekskul, status FROM ekskul WHERE id_ekskul = '" . $data_pendaftar['ekskul_1'] . "'");
            $data_ekskul_1 = mysqli_fetch_assoc($query_ekskul_1);
            $ekskul_1_name = $data_ekskul_1['nama_ekskul'];
            $alasan_1 = $data_pendaftar['alasan_1'];
            if ($data_ekskul_1['status'] == 'non-aktif') {
                $ekskul_1_name .= ' (Non-Aktif)';
            }
        }
        
        if ($data_pendaftar['ekskul_2']) {
            $query_ekskul_2 = mysqli_query($conn, "SELECT nama_ekskul, status FROM ekskul WHERE id_ekskul = '" . $data_pendaftar['ekskul_2'] . "'");
            $data_ekskul_2 = mysqli_fetch_assoc($query_ekskul_2);
            $ekskul_2_name = $data_ekskul_2['nama_ekskul'];
            $alasan_2 = $data_pendaftar['alasan_2'];
            if ($data_ekskul_2['status'] == 'non-aktif') {
                $ekskul_2_name .= ' (Non-Aktif)';
            }
        }
    }
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title mb-4">Pilih Ekstrakurikuler</h3>
                        <?php if (!$data_diri_lengkap): ?>
                            <div class="alert alert-warning">
                                <h4 class="text-center">Mohon untuk mengisi data diri anda terlebih dahulu</h4>
                                <div class="text-center mt-3">
                                    <a href="daftardatadiri.php" class="btn btn-primary">Isi Data Diri</a>
                                </div>
                            </div>
                        <?php else: ?>
                        <form action="#" method="POST" id="formEkskul">
                            <div class="row justify-content-center mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select id="ekskulSelect" class="form-control form-control-lg text-center" style="border-radius: 25px;" <?= $sudah_daftar ? 'disabled' : '' ?>>
                                            <option selected disabled>Tekan untuk pilih</option>
                                            <?php 
                                            mysqli_data_seek($query_all_ekskul, 0); 
                                            while ($ekskul = mysqli_fetch_assoc($query_all_ekskul)) { 
                                                $disabled = ($ekskul['status'] == 'nonaktif') ? 'disabled' : '';
                                                $status_text = ($ekskul['status'] == 'nonaktif') ? ' (Ditutup)' : '';
                                            ?>
                                                <option value="<?= $ekskul['id_ekskul']; ?>" <?= $disabled ?>>
                                                    <?= $ekskul['nama_ekskul'] . $status_text ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                        <input type="hidden" name="id_user" value="<?= $id_user; ?>">
                                    </div>
                                </div>
                            </div>
                            <h4 class="text-center mb-4">DAFTAR EKSTRAKURIKULER YANG DI PILIH</h4>
                            <div class="table-responsive pt-3">
                                <table class="table table-striped" id="tabelEkskul">
                                    <thead>
                                        <tr>
                                            <th width="10%">No</th>
                                            <th>Daftar Ekskul Yang Dipilih</th>
                                            <th>Alasan</th>
                                            <?php if(!$sudah_daftar): ?>
                                                <th width="15%">Aksi</th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody id="ekskulList">
                                        <?php if($sudah_daftar): ?>
                                            <?php if($ekskul_1_name): ?>
                                                <tr>
                                                    <td class="text-center">1</td>
                                                    <td><?= $ekskul_1_name ?></td>
                                                    <td><?= $alasan_1 ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if($ekskul_2_name): ?>
                                                <tr>
                                                    <td class="text-center">2</td>
                                                    <td><?= $ekskul_2_name ?></td>
                                                    <td><?= $alasan_2 ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            <?php if(!$sudah_daftar): ?>
                                <div class="row mt-4">
                                    <div class="col-md-12 text-end">
                                        <button type="button" id="daftarButton" class="btn btn-success text-white">Daftar</button>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </form>
                        <br>
                        <?php if($sudah_daftar): ?>
                            <div class="alert alert-success">
                                <h4 class="text-center">Anda Telah Mendaftar Ekstrakurikuler</h4>
                            </div>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if(!$sudah_daftar): ?>
<div class="modal fade" id="finalisasiModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="tambahdaftarekskul.php" method="POST" id="formFinalisasiEkskul">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Finalisasi</h5>
                    <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center mb-4">Silahkan berikan alasan mengapa ingin bergabung dengan ekstrakurikuler berikut:</p>
                    
                    <div id="modalReasonForms">
                    </div>
                    
                    <p class="text-danger mt-4"><strong>Perhatian:</strong> Setelah difinalisasi, Anda tidak dapat mengubah pilihan ekstrakurikuler.</p>
                    
                    <input type="hidden" name="ekskul_1" id="ekskul_1">
                    <input type="hidden" name="ekskul_2" id="ekskul_2">
                    <input type="hidden" name="alasan_1" id="alasan_1">
                    <input type="hidden" name="alasan_2" id="alasan_2">
                    <input type="hidden" name="id_user" value="<?= $id_user; ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light"  data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success text-white">Ya, Daftar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="reasonModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Alasan Memilih <span id="ekskulName"></span></h5>
                <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="reasonInput">Mengapa Anda ingin mengikuti ekskul ini?</label>
                    <textarea class="form-control" id="reasonInput" rows="3" placeholder="Masukkan alasan Anda"></textarea>
                </div>
                <input type="hidden" id="ekskulIndex">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="saveReason">Simpan</button>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<script>
let userId = '<?= $id_user ?>';
let ekskulTerpilih = JSON.parse(localStorage.getItem('ekskulTerpilih_' + userId)) || [];
let sudahDaftar = <?= $sudah_daftar ? 'true' : 'false' ?>;

document.addEventListener('DOMContentLoaded', function () {
    if (!sudahDaftar) {
        updateTabel();

        $('#ekskulSelect').on('change', function () {
            const id = $(this).val();
            const text = $("#ekskulSelect option:selected").text();
            const isDisabled = $("#ekskulSelect option:selected").is(':disabled');

            if (isDisabled) {
                alert("Ekstrakurikuler ini sedang tidak menerima pendaftaran");
                $(this).val('');
                return;
            }

            if (ekskulTerpilih.length >= 2) {
                alert("Hanya bisa memilih maksimal 2 ekskul");
                return;
            }

            if (ekskulTerpilih.some(e => e.id === id)) {
                alert("Ekskul sudah dipilih");
                return;
            }

            ekskulTerpilih.push({ id, text, reason: '' });
            simpanKeLocalStorage();
            updateTabel();
            
            // Tampilkan modal untuk memasukkan alasan
            const index = ekskulTerpilih.length - 1;
            $('#ekskulName').text(text);
            $('#ekskulIndex').val(index);
            $('#reasonInput').val('');
            $('#reasonModal').modal('show');
        });

        $('#tabelEkskul').on('click', '.editReason', function () {
            const index = $(this).data('index');
            $('#ekskulName').text(ekskulTerpilih[index].text);
            $('#ekskulIndex').val(index);
            $('#reasonInput').val(ekskulTerpilih[index].reason);
            $('#reasonModal').modal('show');
        });

        $('#tabelEkskul').on('click', '.hapusEkskul', function () {
            const index = $(this).data('index');
            ekskulTerpilih.splice(index, 1);
            simpanKeLocalStorage();
            updateTabel();
        });

        $('#saveReason').on('click', function () {
            const index = parseInt($('#ekskulIndex').val());
            const reason = $('#reasonInput').val().trim();
            
            if (!reason) {
                alert("Harap masukkan alasan memilih ekskul ini");
                return;
            }
            
            ekskulTerpilih[index].reason = reason;
            simpanKeLocalStorage();
            updateTabel();
            $('#reasonModal').modal('hide');
        });

        // Ganti event handler untuk tombol Daftar
        $('#daftarButton').on('click', function() {
            if (ekskulTerpilih.length === 0) {
                alert("Anda belum memilih ekskul.");
                return;
            }
            
            // Cek apakah semua ekskul memiliki alasan
            let reasonsCompleted = true;
            ekskulTerpilih.forEach((item, index) => {
                if (!item.reason || item.reason.trim() === '') {
                    reasonsCompleted = false;
                    // Tampilkan modal alasan jika belum diisi
                    $('#ekskulName').text(item.text);
                    $('#ekskulIndex').val(index);
                    $('#reasonInput').val('');
                    $('#reasonModal').modal('show');
                    return false; // Keluar dari forEach
                }
            });
            
            // Jika semua alasan sudah diisi, tampilkan modal finalisasi
            if (reasonsCompleted) {
                // Siapkan form alasan dalam modal finalisasi
                let reasonForms = '';
                ekskulTerpilih.forEach((ekskul, index) => {
                    reasonForms += `
                        <div class="form-group mb-4">
                            <h6 class="font-weight-bold">${ekskul.text}</h6>
                            <p>${ekskul.reason}</p>
                        </div>
                        <hr>
                    `;
                });
                
                $('#modalReasonForms').html(reasonForms);
                
                // Set nilai hidden fields
                $('#ekskul_1').val(ekskulTerpilih[0]?.id || '');
                $('#alasan_1').val(ekskulTerpilih[0]?.reason || '');
                
                if (ekskulTerpilih.length > 1) {
                    $('#ekskul_2').val(ekskulTerpilih[1]?.id || '');
                    $('#alasan_2').val(ekskulTerpilih[1]?.reason || '');
                }
                
                $('#finalisasiModal').modal('show');
            }
        });

        // Validasi form sebelum submit
        $('#formFinalisasiEkskul').on('submit', function(e) {
            // Set nilai hidden fields sekali lagi untuk memastikan
            $('#ekskul_1').val(ekskulTerpilih[0]?.id || '');
            $('#alasan_1').val(ekskulTerpilih[0]?.reason || '');
            
            if (ekskulTerpilih.length > 1) {
                $('#ekskul_2').val(ekskulTerpilih[1]?.id || '');
                $('#alasan_2').val(ekskulTerpilih[1]?.reason || '');
            }
        });

        $('select').select2({
            placeholder: 'Tekan untuk pilih',
            width: '100%',
            dropdownCssClass: 'text-center'
        });
    }
});

function updateTabel() {
    let html = '';

    if (ekskulTerpilih.length === 0) {
        html = `
            <tr>
                <td colspan="4" class="text-center">Belum ada ekstrakurikuler yang dipilih</td>
            </tr>
        `;
    } else {
        ekskulTerpilih.forEach((e, i) => {
            const reasonText = e.reason ? e.reason : '<span class="text-danger">Belum diisi</span>';
            html += `
                <tr>
                    <td class="text-center">${i + 1}</td>
                    <td>${e.text}</td>
                    <td>${reasonText}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-info btn-sm editReason me-1 text-white" data-index="${i}" style="font-family: 'Segoe UI', sans-serif;">
                             Alasan Memilih
                        </button>
                        <button type="button" class="btn btn-danger btn-sm hapusEkskul text-white" data-index="${i}" style="font-family: 'Segoe UI', sans-serif;">
                               Hapus
                        </button>

                    </td>
                </tr>
            `;
        });
    }

    $('#ekskulList').html(html);

    if (ekskulTerpilih.length === 0) {
        $('#daftarButton').prop('disabled', true);
    } else {
        $('#daftarButton').prop('disabled', false);
    }
}

function simpanKeLocalStorage() {
    localStorage.setItem('ekskulTerpilih_' + userId, JSON.stringify(ekskulTerpilih));
}
</script>