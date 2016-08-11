<?php session_start(); require_once "config.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-BUDGETING | SMAN 1 WANADADI</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>  body { margin-top: 40px; } </style>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">SMAN 1 WANADADI</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-left">
                        <li><a href="?halaman=home">Home <span class="sr-only">(current)</span></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Input <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="?halaman=kriteria_masuk">Kriteria Masuk</a></li>
                                <li><a href="?halaman=sub_kriteria">Sub Kriteria</a></li>
                                <li><a href="?halaman=variabel_guna_masuk">Variable Guna Masuk</a></li>
                                <li class="divider"></li>
                                <li><a href="?halaman=kriteria_keluar">Kriteria Keluar</a></li>
                                <li><a href="?halaman=variabel_guna_keluar">Variabel Guna Keluar</a></li>
                                <li><a href="?halaman=sub_var_guna_keluar">Sub Variabel Guna Keluar</a></li>
                                <li class="divider"></li>
                                <li><a href="?halaman=komponen_sub_var_guna">Komponen Sub Variabel Guna</a></li>
                                <li><a href="?halaman=sub_komponen_sub_var_guna">Sub Komponen Sub Variabel Guna</a></li>
                                <li class="divider"></li>
                                <li><a href="?halaman=tim_rkaas">Tim RKAAS</a></li>
                            </ul>
                        </li>
                        <li><a href="?halaman=pengambilan_dana">Pengambilan Dana</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Rekap <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="?halaman=rekap_a">A. Rekapitulasi Penerimaan Dana Anggaran</a></li>
                                <li><a href="?halaman=rekap_b">B. Rincian Penghitungan Pembelanjaan Tiap Kegiatan</a></li>
                                <li><a href="?halaman=rekap_c">C. Rincian Berdasarkan Sumber Dana</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php if (isset($_SESSION['is_logged'])): ?>
                            <li><a href="logout.php">Logout</a></li>
                        <?php endif ?>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="row">
            <div class="col-md-12">
                <?php
                switch ($halaman) {
                    case 'kriteria_masuk': $halaman = 'kriteria_masuk'; break;
                    case 'sub_kriteria': $halaman = 'sub_kriteria'; break;
                    case 'variabel_guna_masuk': $halaman = 'variabel_guna_masuk'; break;
                    case 'kriteria_keluar': $halaman = 'kriteria_keluar'; break;
                    case 'variabel_guna_keluar': $halaman = 'variabel_guna_keluar'; break;
                    case 'sub_var_guna_keluar': $halaman = 'sub_var_guna_keluar'; break;
                    case 'komponen_sub_var_guna': $halaman = 'komponen_sub_var_guna'; break;
                    case 'sub_komponen_sub_var_guna': $halaman = 'sub_komponen_sub_var_guna'; break;
                    case 'tim_rkaas': $halaman = 'tim_rkaas'; break;
                    case 'pengambilan_dana': $halaman = 'pengambilan_dana'; break;
                    case 'rekap_a': $halaman = 'rekap_a'; break;
                    case 'rekap_b': $halaman = 'rekap_b'; break;
                    case 'rekap_c': $halaman = 'rekap_c'; break;
                    default: $halaman = "home"; break;
                }
                include "halaman/" . $halaman . ".php";
                ?>
            </div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>