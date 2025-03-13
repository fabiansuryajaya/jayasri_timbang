<?php
include 'config/koneksi.php';
include 'config/fungsi.php';
include 'page/Model/Login.php';
include 'page/Model/Setting.php';
if (isset($_SESSION['sesi_aktif'])) {
    echo "<script>document.location='page/index.php';</script>";
}
if (isset($_POST['username'])) {
    if (cari($_POST['username'], $_POST['password']) == 200) {
        echo "<script>document.location = 'page/index.php';</script>";
    } else {
        echo "<script>alert('User dan Password tidak ditemukan.');document.location = 'index.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login System</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="assets/image/<?php echo favicon(); ?>" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/login/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <!-- <link rel="stylesheet" type="text/css" href="assets/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css"> -->
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/login/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <!-- <link rel="stylesheet" type="text/css" href="assets/login/vendor/css-hamburgers/hamburgers.min.css"> -->
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/login/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================--><!-- 
    <link rel="stylesheet" type="text/css" href="assets/login/vendor/select2/select2.min.css">
===============================================================================================    
    <link rel="stylesheet" type="text/css" href="assets/login/vendor/daterangepicker/daterangepicker.css"> -->
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/login/css/util.css">
    <link rel="stylesheet" type="text/css" href="assets/login/css/main.css">
    <!--===============================================================================================-->
</head>

<body style="background-color: #666666;">

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form" method="POST" action=""
                    style="width: 400px !important; background-color: #fff !important;">
                    <span class="login100-form-title  ">
                        <img src="assets/image/<?php echo logo(); ?>" style="width: 190px;">
                    </span>
                    <span class="login100-form-title p-b-5 p-t-20">
                        <p class="fs-20"><?php echo judul(); ?></p>
                    </span>
                    <hr />
                    <span class="login100-form-title p-b-20">
                        <p class="fs-20">Silahkan Login</p>
                    </span>


                    <div class="wrap-input100 validate-input" data-validate="Username wajib diisi.">
                        <input class="input100" name="username" autocomplete="off" type="text" name="text">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Username</span>
                    </div>


                    <div class="wrap-input100 validate-input" data-validate="Password wajib diisi.">
                        <input class="input100" autocomplete="off" type="password" name="password">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Password</span>
                    </div>

                    <div class="flex-sb-m w-full p-t-3 p-b-32">
                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                            <label class="label-checkbox100" for="ckb1">
                                Ingat Saya
                            </label>
                        </div>

                        <div>
                            <a href="#" class="txt1">
                                Lupa Password?
                            </a>
                        </div>
                    </div>


                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Login
                        </button>
                    </div>


                </form>

                <div class="login100-more" style="background-image: url('assets/image/<?php echo gambar_login(); ?>');">
                </div>
            </div>
        </div>
    </div>

    <!--===============================================================================================-->
    <script src="assets/login/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="assets/login/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="assets/login/vendor/bootstrap/js/popper.js"></script>
    <script src="assets/login/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <!--     <script src="assets/login/vendor/select2/select2.min.js"></script> -->
    <!--===============================================================================================-->
    <!--     <script src="assets/login/vendor/daterangepicker/moment.min.js"></script>
    <script src="assets/login/vendor/daterangepicker/daterangepicker.js"></script> -->
    <!--===============================================================================================-->
    <!--     <script src="assets/login/vendor/countdowntime/countdowntime.js"></script> -->
    <!--===============================================================================================-->
    <script src="assets/login/js/main.js"></script>
</body>

</html>