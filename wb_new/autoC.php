<?php
header('Access-Control-Allow-Origin');
extract($_POST);
include '../config/koneksi.php';
if (isset($_POST['cari'])) {
    $queryx = "SELECT * FROM master_produk WHERE nama_produk LIKE '%" . $cari . "%' AND rowstatus=1 LIMIT 10";


    $res = array();
    $data = array();
    $qry = mysqli_query($k, $queryx);
    $output = '<ul class="ull  list-unstyled">';
    if (mysqli_num_rows($qry) > 0) {
        while ($d = mysqli_fetch_array($qry)) {
            $output .= "<li class='lii ' onclick='setData(\"$id\",\"$idlist\",\"$d[id]\",\"$d[nama_produk]\",\"$d[satuan]\",\"$d[harga_pokok]\",\"$d[harga_jual]\")'>" . $d['nama_produk'] . '-' . $d['satuan'] . "</li>";
        }
    } else {
        // $output .= "<li class='lii ' onclick='setData(\"\",\"\",\"\",\"\",\"\")'>Tutup</li>"; 
    }
    $output .= '</ul>';
    echo $output;
}

?>