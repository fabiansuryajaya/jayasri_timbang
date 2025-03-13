<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
    $k = mysqli_connect('localhost', 'root', '', 'jayasri_new');
    $baudrates = [110, 300, 600, 1200, 2400, 4800, 9600, 14400, 19200, 38400];
