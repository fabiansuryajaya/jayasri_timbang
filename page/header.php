<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <title><?php echo judul(); ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="../assets/image/<?php echo favicon(); ?>">
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

    <script src="../assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: { "families": ["Lato:300,400,700,900"] },
            custom: { "families": ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['../assets/css/fonts.min.css'] },
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/atlantis.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.css">
    <link rel="stylesheet" href="../assets/css/select2.min.css">
    <link rel="stylesheet" href="../assets/css/sweetalert2.css">
    <script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>
    <script src="../assets/js/ajax_jquery.js"></script>
    <script src="../assets/js/core/jquery.3.2.1.min.js"></script>

    <!-- <script src="../assets/js/jquery211.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="../assets/js/typeahead.js"></script>

    <!-- Chart JS -->
    <script src="../assets/js/plugin/chart.js/chart.min.js"></script>
    <!-- Datatables -->

    <!-- Datatables -->
    <link rel="stylesheet" href="../assets/datatables/datatables.min.css">
    <link rel="stylesheet" href="../assets/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/datatables/Select-1.2.4/css/select.bootstrap4.min.css">

    <!-- CSS MOD -->
    <link rel="stylesheet" type="text/css" href="../assets/css/modaldy.css">
</head>

<body>
    <div class="wrapper">
        <div class="main-header">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="blue">

                <a href="index.php" class="logo">
                    <center>
                        <h2 class="white navbar-brand"><?php echo singkatan(); ?>
                    </center>
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                    data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="fas fa-tasks"></i>
                    </span>
                </button>
                <button class="topbar-toggler more">
                    <i class="fas fa-angle-double-right"></i>
                </button>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="fas fa-angle-double-right"></i>
                    </button>
                </div>
            </div>
            <!-- End Logo Header -->

            <!-- Navbar Header -->
            <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

                <div class="container-fluid">

                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        <li class="nav-item dropdown hidden-caret">
                            <div class="white animated fadeIn" style="text-transform: capitalize;">
                                Welcome <strong><?php echo $_SESSION["nama_user"]; ?></strong>
                            </div>
                        </li>
                        <li class="nav-item dropdown hidden-caret">
                            <a href="logout.php" class="btn btn-toggle  "><i class="fas fa-power-off"></i>
                                <p style="    margin-bottom: 0px;">Logout</p>
                            </a>

                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</body>