<?php

session_start();
unset($_SESSION['is_logged']);
header('Location: index.php');