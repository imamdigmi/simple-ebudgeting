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
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="?halaman=home">Home <span class="sr-only">(current)</span></a></li>
                        <?php if (isset($_SESSION['is_logged'])): ?>
                            <li><a href="logout.php">Logout</a></li>
                        <?php endif ?>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="row">
            <div class="col-md-9">
                <?php
                switch ($halaman) {
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