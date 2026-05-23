<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Data Diri Siswa - Ekstrakurikuler MUTIL</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="shortcut icon" href="assets/images/logo1.png" />
</head>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-6 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo text-center">
                <img src="assets/images/logo.png" alt="logo" style="width: 250px;">
              </div>
              <h4 class="text-center">Lengkapi Data Diri</h4>
              <form class="pt-3" action="tambahdatadiri.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="nama_lengkap" placeholder="Nama Lengkap" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="nis" placeholder="NIS" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="kelas" placeholder="Kelas (Contoh: XI RPL)" required>
                </div>
                <div class="form-group">
                  <select class="form-select form-control-lg" name="jenis_kelamin" required>
                    <option selected disabled>Pilih Jenis Kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                  </select>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="no_hp" placeholder="Nomor HP Aktif" required>
                </div>
                <div class="form-group">
                  <textarea class="form-control form-control-lg" name="alamat" rows="3" placeholder="Alamat Lengkap" required></textarea>
                </div>
                <div class="form-group">
                  <label for="foto" class="form-label">Foto Profil (Maks. 2MB)</label>
                  <input type="file" class="form-control form-control-lg" id="foto" name="foto" accept="image/*" required>
                  <small class="text-muted">Format: JPG/JPEG/PNG, Ukuran maksimal 2MB</small>
                </div>
                <div class="mt-3 d-grid gap-2">
                  <button type="submit" class="btn btn-block btn-success text-white btn-lg font-weight-medium auth-form-btn" name="tambah">Simpan & Lanjut</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/template.js"></script>
</body>
</html>