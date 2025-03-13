<?php
    // header('Content-Type: application/json');
    // header('Access-Control-Allow-Origin: *');
    header('Content-Type: multipart/x-mixed-replace; boundary=myboundary');
    include '../Config/koneksi.php';
    error_reporting(E_ALL);

    if (isset($_GET['cctv'])) {
        $cctv = $_GET['cctv']; 
        $x = mysqli_fetch_array(mysqli_query($k,"SELECT * FROM conf_sistem WHERE `desc`='$cctv'"));
        $streamUrl = $x['content'];
        $username = explode(":",$x['notes'])[0];
        $password = explode(":",$x['notes'])[1];
        header('Content-Type: multipart/x-mixed-replace; boundary=myboundary');

        while (true) {
            $stream = fopen($streamUrl, 'rb');
            if (!$stream) {
                die('Error opening stream');
            }

            // Read and display each frame
            while ($frame = fread($stream, 4096)) {
                echo $frame;
                ob_flush();
                flush();
            }

            fclose($stream);
        }
    }