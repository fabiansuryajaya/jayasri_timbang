<?php
error_reporting(0);
header('Content-Type: application/json');

header('Access-Control-Allow-Origin: *');


include '../connect.php';

if (isset($_POST['data_sopir'])) {
    $xz = "SELECT a.id, a.`nama_dtl`, b.`nama_vendor` FROM tb_driver_tl a LEFT JOIN tb_vendor_tl_dtl b ON a.`id_vendor`=b.`id` WHERE a.`rowstatus`=1";
    $response['data'] = array();
    $cari = mysqli_query($k, $xz);
    if (mysqli_num_rows($cari) > 0) {
        while ($data = mysqli_fetch_array($cari)) {
            $res["id"] = $data['id'];
            $res["vendor"] = $data['nama_vendor'];
            $res["nama_sopir"] = strtoupper($data['nama_dtl']);
            array_push($response['data'], $res);
        }
        echo json_encode($response);

    } else {
        $response["code"] = "404";
        $response["message"] = "Error";

        echo json_encode($response);

    }
}

if (isset($_POST['add_sopir'])) {
    $nama_sopirX = $_POST['nama_sopirX'];
    $vendorX = $_POST['vendorX'];

    $cek = mysqli_query($k, "SELECT * FROM tb_driver_tl WHERE rowstatus=1 AND nama_dtl = '$nama_sopirX' AND id_vendor='$vendorX'");
    if (mysqli_num_rows($cek) <= 0) {
        $ins = mysqli_query($k, "INSERT INTO tb_driver_tl (id_vendor,nama_dtl,createdby,createdon,rowstatus) VALUES ('$vendorX','$nama_sopirX','WB',NOW(),'1')");

        if ($ins) {
            $response["code"] = "200";
            $response["message"] = "Berhasil Disimpan";
        } else {
            $response["code"] = "404";
            $response["message"] = "Gagal Disimpan";
        }
    } else {
        $response["code"] = "300";
        $response["message"] = "Duplikat Nama dan vendor";
    }

    echo json_encode($response);
}

if (isset($_POST['del_sopir'])) {
    $id = $_POST['id'];
    $upd = mysqli_query($k, "UPDATE tb_driver_tl SET rowstatus=0 WHERE id='$id'");

    if ($upd) {
        $response["code"] = "200";
        $response["message"] = "Berhasil Dihapus";
    } else {
        $response["code"] = "404";
        $response["message"] = "Gagal Dihapus";
    }


    echo json_encode($response);
}

// DATA KENDARAAN


if (isset($_POST['data_kendaraan'])) {
    $xz = "SELECT a.id, a.`nomor_polisi`, b.`nama_vendor` FROM tb_tank_lorry a LEFT JOIN tb_vendor_tl_dtl b ON a.`id_vendor`=b.`id` WHERE a.`rowstatus`=1";
    $response['data'] = array();
    $cari = mysqli_query($k, $xz);
    if (mysqli_num_rows($cari) > 0) {
        while ($data = mysqli_fetch_array($cari)) {
            $res["id"] = $data['id'];
            $res["nopol"] = $data['nomor_polisi'];
            $res["vendor"] = $data['nama_vendor'];
            array_push($response['data'], $res);
        }
        echo json_encode($response);

    } else {
        $response["code"] = "404";
        $response["message"] = "Error";

        echo json_encode($response);

    }
}

if (isset($_POST['add_kendaraan'])) {
    $nopolX = $_POST['nopolX'];
    $vendorXy = $_POST['vendorXy'];

    $cek = mysqli_query($k, "SELECT * FROM tb_tank_lorry WHERE rowstatus=1 AND nomor_polisi = '$nopolX' AND id_vendor='$vendorXy'");
    if (mysqli_num_rows($cek) <= 0) {
        $ins = mysqli_query($k, "INSERT INTO tb_tank_lorry (id_vendor,nomor_polisi,createdby,createdon,rowstatus) VALUES ('$vendorXy','$nopolX','WB',NOW(),'1')");

        if ($ins) {
            $response["code"] = "200";
            $response["message"] = "Berhasil Disimpan";
        } else {
            $response["code"] = "404";
            $response["message"] = "Gagal Disimpan";
        }
    } else {
        $response["code"] = "300";
        $response["message"] = "Duplikat Nomor Polisi";
    }

    echo json_encode($response);
}

if (isset($_POST['del_kendaraan'])) {
    $id = $_POST['id'];
    $upd = mysqli_query($k, "UPDATE tb_tank_lorry SET rowstatus=0 WHERE id='$id'");

    if ($upd) {
        $response["code"] = "200";
        $response["message"] = "Berhasil Dihapus";
    } else {
        $response["code"] = "404";
        $response["message"] = "Gagal Dihapus";
    }


    echo json_encode($response);
}
// ASAL

?>