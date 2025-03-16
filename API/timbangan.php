<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include '../config/koneksi.php';
include '../config/fungsi.php';

session_start();
$filename = "data_" . date("Y-m-d") . ".txt";
$directory = "txt/"; // Ganti dengan direktori yang sesuai
$file = fopen($directory . $filename, "a");

if (!file_exists($directory)) {
    mkdir($directory, 0777, true);
}

if (isset($_GET['record'])) {
    $mode = $_GET['record'];
    if ($mode == 01) {
        $textMode = "Pengiriman"; //pengiriman
    } else {
        $textMode = "Penerimaan"; //penerimaan
    }

    $xz = "SELECT tiket, 
    IF(
        tiket != '',
        CONCAT('TKT-', '$mode', '-', LPAD(CAST(SUBSTRING_INDEX(tiket, CONCAT('TKT-', '$mode', '-'), -1) AS UNSIGNED) + 1, 3, '0')),
        CONCAT('TKT-', '$mode', '-001')
        ) AS nomor 
    FROM tb_weighing_scale 
    WHERE mode_timbang = '$textMode' 
    AND tiket LIKE CONCAT('TKT-', '$mode', '-%')  
    ORDER BY id DESC
    LIMIT 1";
    $response = array();
    $cari = mysqli_query($k, $xz);

    $gudang = mysqli_fetch_array(mysqli_query($k, "SELECT content FROM conf_sistem WHERE id=26 LIMIT 1"));
    $produk = mysqli_fetch_array(mysqli_query($k, "SELECT * FROM master_produk WHERE rowstatus=1 ORDER BY id ASC LIMIT 1"));
    $response["gudang"] = $gudang['content'];
    $response["material"] = $produk['nama_produk'];
    $response["hpp"] = $produk['harga_pokok'];
    $response["hjp"] = $produk['harga_jual'];
    $response["id_material"] = $produk['id'];

    if (mysqli_num_rows($cari) > 0) {
        $data = mysqli_fetch_array($cari);
        $response["tiket"] = $data['nomor'];
        $response["gudang"] = $gudang['content'];
        echo json_encode($response);
    } else {
        $response["tiket"] = "TKT-$mode-1";
        $response["code"] = "404";
        $response["message"] = "Error";
        echo json_encode($response);
    }
}

if (isset($_POST['save_hasil'])) {
    $tiket = $_POST['tiket'];
    $tara = str_replace(" ", "", $_POST['tara']);
    $taraOCR = str_replace(" ", "", $_POST['taraOCR']);
    $material = $_POST['material'];
    $kendaraan = $_POST['kendaraan'];
    $plate_recognize = $_POST['plate_recognize'];
    $pengemudi = $_POST['pengemudi'];
    $asal = $_POST['asal'];
    $tujuan = $_POST['tujuan'];
    $catatan = $_POST['catatan'];
    $gudang = $_POST['gudang'];
    $tglmasuk = $_POST['tglmasuk'];
    $nama_user = $_SESSION["nama_user"];
    // mode 
    $mode = $_POST['mode'];
    // material
    $id_material = $_POST['id_material'];
    $hpp = $_POST['hpp'];
    $hjp = $_POST['hjp'];

    $qryz = "INSERT INTO  `tb_weighing_scale` (`id_produk`,`mode_timbang`, `tiket`, `gudang`, `kendaraan`,`plate_recognize`, `pengemudi`, `tgl_masuk`, `asal`,`tujuan`,`material`, `timbang1`,`ocrTimbang1`,  `catatan`,`harga_pokok`,`harga_jual`, `createdby`, `createdon`, `rowstatus`) VALUES ('$id_material','$mode','$tiket', '$gudang', '$kendaraan','$plate_recognize', '$pengemudi', now(), '$asal','$tujuan', '$material', '$tara','$taraOCR', '$catatan','$hpp','$hjp','$nama_user', NOW(), '1')";
    $txt = "[" . date('Y-m-d H:i:s') . "] " . $qryz . "\n";
    fwrite($file, $txt);

    $ins = mysqli_query($k, $qryz);
    if ($ins) {
        $response["code"] = "200";
        $response["message"] = "Berhasil Disimpan";
    } else {
        $response["code"] = "404";
        $response["message"] = "Error";
    }
    echo json_encode($response);
}

if (isset($_POST['save_hasil2'])) {
    $timbang2 = trim($_POST['timbang2']);
    $timbang2ocr = trim($_POST['timbang2ocr']);
    $tiket = $_POST['tiket'];
    $id = $_POST['id'];

    $totalhjp = cleanNumber($_POST['totalhjp']);
    $hpp_total = cleanNumber($_POST['hpp_total']);

    $plate_recognize2 = $_POST['plate_recognize2'];
    $plat_correct2 = $_POST['plat_correct2'];

    $qryz = "UPDATE  `tb_weighing_scale` SET `kendaraan2`='$plat_correct2', `plate_recognize2`='$plate_recognize2',    `tgl_keluar` = NOW(),   `timbang2` = '$timbang2', `ocrTimbang2`='$timbang2ocr',  `hpp_total`='$hpp_total', `harga_total`='$totalhjp'   WHERE `id` = '$id'";
    $ins = mysqli_query($k, $qryz);

    $txt = "[" . date('Y-m-d H:i:s') . "] " . $qryz . "\n";
    fwrite($file, $txt);

    if ($ins) {
        $response["code"] = "200";
        $response["message"] = "$tiket Berhasil Disimpan";
    } else {
        $response["code"] = "404";
        $response["message"] = "Error";
    }
    echo json_encode($response);
}

if (isset($_POST['load_table'])) {
    $xz = "SELECT id,tiket,plate_recognize, kendaraan,pengemudi, tgl_masuk   AS tgl,gudang, ocrTimbang1, timbang1,material,catatan, mode_timbang, asal, tujuan FROM tb_weighing_scale WHERE (timbang2 IS NULL OR timbang2='') AND rowstatus=1 ORDER BY id DESC";
    $response['data'] = array();
    $cari = mysqli_query($k, $xz);
    if (mysqli_num_rows($cari) > 0) {
        while ($data = mysqli_fetch_array($cari)) {
            $res["id"] = $data['id'];
            $res["mode_timbang"] = $data['mode_timbang'];
            $res["tiket"] = $data['tiket'];
            $res["gudang"] = $data['gudang'];
            $res["pengemudi"] = $data['pengemudi'];
            $res["plate_recognize"] = $data['plate_recognize'];
            $res["kendaraan"] = $data['kendaraan'];
            $res["asal"] = $data['asal'];
            $res["tujuan"] = $data['tujuan'];
            $res["tgl"] = $data['tgl'];
            $res["catatan"] = $data['catatan'];
            $res["material"] = $data['material'];
            $res["taraOCR"] = $data['ocrTimbang1'];
            $res["tara"] = number_format((float) $data['timbang1']);
            array_push($response['data'], $res);
        }
        echo json_encode($response);
    } else {
        $response["code"] = "404";
        $response["message"] = "Error";
        echo json_encode($response);
    }
}


if (isset($_POST['load_table_transaksi'])) {
    $tgl1 = $_POST['tgl1'];
    $tgl2 = $_POST['tgl2'];
    $f_jenis = $_POST['f_jenis'];
    $f_customer = $_POST['f_customer'];
    $f_supplier = $_POST['f_supplier'];
    $f_material = $_POST['f_material'];

    $xz = "SELECT * FROM tb_weighing_scale WHERE   DATE(`tgl_masuk`) BETWEEN '$tgl1' AND '$tgl2' AND mode_timbang LIKE '$f_jenis'  AND `asal` LIKE '$f_supplier' AND `tujuan` LIKE '$f_customer' AND material LIKE '$f_material' AND rowstatus=1 ORDER BY id DESC";
    $response['data'] = array();
    $cari = mysqli_query($k, $xz);
    if (mysqli_num_rows($cari) > 0) {
        while ($data = mysqli_fetch_array($cari)) {
            $netto = number_format(abs($data['timbang1'] - $data['timbang2']));
            $res["id"] = $data['id'];
            $res["tiket"] = $data['tiket'];
            $res["gudang"] = $data['gudang'];
            $res["mode_timbang"] = $data['mode_timbang'];
            $res["kendaraan"] = $data['kendaraan'];
            $res["kendaraan2"] = $data['kendaraan2'];
            $res["plate_recognize"] = $data['plate_recognize'];
            $res["plate_recognize2"] = $data['plate_recognize2'];
            $res["pengemudi"] = $data['pengemudi'];
            $res["tgl_masuk"] = explode(" ", $data['tgl_masuk'])[0];
            $res["tgl_keluar"] = $data['tgl_keluar'];
            $res["asal"] = $data['asal'];
            $res["tujuan"] = $data['tujuan'];
            $res["material"] = $data['material'];
            $res["timbang1"] = $data['timbang1'];
            $res["ocrTimbang1"] = $data['ocrTimbang1'];
            $res["timbang2"] = $data['timbang2'];
            $res["ocrTimbang2"] = $data['ocrTimbang2'];

            $res["catatan"] = $data['catatan'];
            $res["netto"] = $netto;

            $res["harga_jual"] = $data['harga_jual'];
            $res["harga_total"] = $data['harga_total'];

            array_push($response['data'], $res);
        }
        echo json_encode($response);
    } else {
        $response["code"] = "404";
        $response["message"] = "Error";

        echo json_encode($response);
    }
}

if (isset($_POST['timbangisi'])) {
    $xz = "SELECT * FROM tb_weighing_scale WHERE id='$_POST[kodeLama]' AND rowstatus=1";
    $res = array();
    $cari = mysqli_query($k, $xz);
    if (mysqli_num_rows($cari) > 0) {
        $data = mysqli_fetch_array($cari);
        $res["id"] = $data['id'];
        $res["tiket"] = $data['tiket'];
        $res["pengemudi"] = $data['pengemudi'];
        $res["plate_recognize"] = $data['plate_recognize'];
        $res["kendaraan"] = $data['kendaraan'];
        $res["asal"] = $data['asal'];
        $res["tujuan"] = $data['tujuan'];
        $res["material"] = $data['material'];
        $res["tgl"] = $data['tgl_masuk'];
        $res["taraOCR"] = str_replace(" ", "", $data['ocrTimbang1']);
        $res["tara"] = str_replace(" ", "", $data['timbang1']);
        $res["catatan"] = $data['catatan'];
        $res["nama_user"] = $data['createdby'];
        // add
        $res["gudang"] = $data['gudang'];
        $res["harga_pokok"] = $data['harga_pokok'];
        $res["harga_jual"] = number_format($data['harga_jual']);
        $res["mode_timbang"] = $data['mode_timbang'];

        echo json_encode($res);
    } else {
        $response["code"] = "404";
        $response["message"] = "Error";

        echo json_encode($response);
    }
}

if (isset($_POST['detail_data'])) {
    $xz = "SELECT * FROM `tb_weighing_scale` WHERE id='$_POST[detail_data]' AND rowstatus = 1";
    $response = array();
    $cari = mysqli_query($k, $xz);

    if ($cari && mysqli_num_rows($cari) > 0) {
        // Fetch all data
        $data = mysqli_fetch_all($cari, MYSQLI_ASSOC);

        // Process each entry if needed
        foreach ($data as &$entry) {
            // Assuming 'timbang1' and 'timbang2' are columns in your result set
            $entry['netto'] = number_format(abs($entry['timbang1'] - $entry['timbang2']));
        }

        // Store the processed data in response
        $response['data'] = $data;
    } else {
        $response['data'] = array();
        $response["code"] = "404";
        $response["message"] = "Error";
    }

    echo json_encode($response);
}

fclose($file);

if (isset($_POST['del_Transaction'])) {
    $id = $_POST['id'];
    $upd = mysqli_query($k, "UPDATE tb_weighing_scale SET rowstatus=0 WHERE id='$id'");

    if ($upd) {
        $response["code"] = "200";
        $response["message"] = "Berhasil Dihapus";
    } else {
        $response["code"] = "404";
        $response["message"] = "Gagal Dihapus";
    }

    echo json_encode($response);
}