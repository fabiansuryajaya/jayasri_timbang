<?php
    session_start();
    $pass = $_SESSION['pass'];
    $cek = mysqli_query($k, "SELECT password FROM tb_user WHERE password='$pass'");
    if (mysqli_num_rows($cek) <= 0) {
        session_destroy();
        header("Location: ../index.php");
        exit;
    }