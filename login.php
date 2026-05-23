<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login - Ekstrakulikuler Mutil</title>
    <link rel="stylesheet" href="assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/logo1.png" />
    <style>
        .btn-back-top-left {
            position: fixed;
            top: 10px;
            left: 20px;
            z-index: 1000;
            background-color: #57B657;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 12px;
            font-size: 14px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            cursor: pointer;
        }
        .btn-back-top-left:hover {
            background-color: #68bd68;
        }
        .btn-back-top-left i {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <a href="landingpage.php" class="btn-back-top-left">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo text-center">
                                <img src="assets/images/logo.png" alt="logo" style="width: 250px;">
                            </div>
                            <h4>Halo ! Ayo Mulai</h4>
                            <h6 class="font-weight-light">Login Untuk Melanjutkan.</h6>
                            <form class="pt-3" action="proseslogin.php" method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" name="pass" placeholder="Password">
                                </div>
                                <div class="mt-3 d-grid gap-2">
                                    <button class="btn btn-block btn-success text-white btn-lg font-weight-medium auth-form-btn" type="submit" name="login">Log In</button>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Belum Punya Akun? <a href="register.php" class="text-success">Register</a>
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
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
</body>
</html>