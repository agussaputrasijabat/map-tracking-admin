<?php

$module = isset($_GET['module']) ? $_GET['module'] : 'home';
$file = isset($_GET['file']) ? $_GET['file'] : 'index';
$module_file = "modules/" . $module . "/" . $file . ".php";
include 'db.php';

function checkActiveMenu($menu_name, $module)
{
    if ($module == $menu_name) {
        echo 'active';
    } else {
        echo '';
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/pace.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script data-pace-options='{ "ajax": false }' src="assets/js/pace.min.js"></script>
    <script src="assets/js/app.js"></script>
    <title>Map Tracking</title>

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="assets/css/dashboard.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Map Tracking</a>
        <!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <!-- <a class="nav-link" href="#">Sign out</a> -->
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?php checkActiveMenu('home', $module); ?>" href="./">
                                <span data-feather="home"></span>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php checkActiveMenu('device', $module); ?>" href="?module=device">
                                <span data-feather="file"></span>
                                Kendaraan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php checkActiveMenu('location', $module); ?>" href="?module=location">
                                <span data-feather="shopping-cart"></span>
                                Lokasi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php checkActiveMenu('route', $module); ?>" href="?module=route">
                                <span data-feather="users"></span>
                                Rute Kendaraan
                            </a>
                        </li>
                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Fitur</span>
                        <a class="d-flex align-items-center text-muted" href="#">
                            <span data-feather="plus-circle"></span>
                        </a>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link <?php checkActiveMenu('live', $module); ?>" href="?module=live">
                                <span data-feather="file-text"></span>
                                Live Tracking
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?php checkActiveMenu('log', $module); ?>" href="?module=log">
                                <span data-feather="file-text"></span>
                                Riwayat Kendaraan
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <?php
            include $module_file;
            ?>

        </div>
    </div>
</body>

</html>