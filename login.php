<?php
if (isset($_POST['_form']) AND $_POST['_form'] == 'true') {
    require_once "config.php";
    $sql = "SELECT * FROM tim_rkaas WHERE username='$_POST[username]' AND password='" . md5($_POST['password']) . "'";
    if ($query = $koneksi->query($sql)) {
        if ($query->num_rows) {
            session_start();
            while ($data = $query->fetch_array()) {
                $_SESSION['is_logged'] = true;
                $_SESSION['username'] = $data['username'];
                $_SESSION['nama'] = $data['nama'];
                $_SESSION['status'] = $data['status'];
            }
            header('location: index.php');
        } else {
            echo "<script>alert('username/ password tidak sesuai!')</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-BUDGETING | SMAN 1 WANADADI</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style> body { margin-top: 40px; } </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-heading"><h3 class="text-center">LOGIN</h3></div>
                    <div class="panel-body">
                        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" id="username" placeholder="Username" autofocus="on">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-info btn-block">Login</button>
                            <input type="hidden" name="_form" value="true">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>
</html>