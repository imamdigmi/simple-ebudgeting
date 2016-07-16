<?php if ( ! isset($_SESSION['is_logged'])) header('location: login.php');?>

<h2>Selamat Datang <?=ucwords($_SESSION['username'])?></h2>