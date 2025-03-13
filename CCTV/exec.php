<?php
include '../Config/koneksi.php';

if (isset($_POST['tiket'])) {
    function Exec1($url, $tiket, $cam, $no)
    {
        global $k;
        $file = $url;
        $newfile = "$tiket-cam$cam-$no.jpeg";
        echo $newfile;
        if (!copy($file, $newfile)) {
            echo "Gagal";
        } else {
            $img = file_get_contents($newfile);
            $data = base64_encode($img);
            $qry = "INSERT INTO tb_cctv (tiket,cam,gambar,capture) VALUES ('$tiket','cam$cam-$no','$data','$no')";
            $ins = mysqli_query($k, $qry);
            echo "Berhasil";
        }
    }

    $qr = mysqli_query($k, "SELECT * FROM conf_sistem a WHERE a.desc LIKE 'cam%' AND a.content!=''");
    $no = 1;
    while ($zz = mysqli_fetch_array($qr)) {
        echo Exec1($zz['content'], $_POST['tiket'], $_POST['cam'], $no);
        $no++;
    }
}
