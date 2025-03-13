<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include '../config/koneksi.php';
include '../config/fungsi.php';

// PRODUK
if (isset($_POST['data_produk'])) {
    if (isset($_POST['editProduk'])) {
        $edit = "AND id='$_POST[editProduk]'";
    } else {
        $edit = "";
    }
    $xz = "SELECT * FROM master_produk WHERE rowstatus = 1 $edit ORDER BY id DESC";
    $response = array();
    $cari = mysqli_query($k, $xz);

    if ($cari && mysqli_num_rows($cari) > 0) {
        $response['data'] = mysqli_fetch_all($cari, MYSQLI_ASSOC);
    } else {
        $response['data'] = array();
        $response["code"] = "404";
        $response["message"] = "Error";
    }

    echo json_encode($response);
}

if (isset($_POST['add_produk'])) {
    $edit_produk = $_POST['edit_produk'];
    $nama_produk = $_POST['nama_produk'];
    $satuan = $_POST['satuan'];
    $hpp = $_POST['hpp'];
    $hjp = $_POST['hjp'];

    if ($edit_produk > 0) {
        $upd = mysqli_query($k, "UPDATE master_produk SET nama_produk='$nama_produk', satuan='$satuan', harga_pokok='$hpp',harga_jual='$hjp' WHERE id='$edit_produk'");
        if ($upd) {
            $response["code"] = "200";
            $response["message"] = "Berhasil Disimpan";
        } else {
            $response["code"] = "404";
            $response["message"] = "Gagal Disimpan";
        }
    } else {
        $cek = mysqli_query($k, "SELECT * FROM master_produk WHERE rowstatus=1 AND nama_produk='$nama_produk'");
        if (mysqli_num_rows($cek) <= 0) {
            $ins = mysqli_query($k, "INSERT INTO master_produk (nama_produk,satuan,harga_pokok,harga_jual,rowstatus) VALUES ('$nama_produk','$satuan','$hpp','$hjp','1')");

            if ($ins) {
                $response["code"] = "200";
                $response["message"] = "Berhasil Disimpan";
            } else {
                $response["code"] = "404";
                $response["message"] = "Gagal Disimpan";
            }
        } else {
            $response["code"] = "300";
            $response["message"] = "Duplikat Produk";
        }
    }
    echo json_encode($response);
}

if (isset($_POST['del_produk'])) {
    $id = $_POST['id'];
    $upd = mysqli_query($k, "UPDATE master_produk SET rowstatus=0 WHERE id='$id'");

    if ($upd) {
        $response["code"] = "200";
        $response["message"] = "Berhasil Dihapus";
    } else {
        $response["code"] = "404";
        $response["message"] = "Gagal Dihapus";
    }

    echo json_encode($response);
}

// CUSTOMER
if (isset($_POST['data_customer'])) {
    if (isset($_POST['editCustomer'])) {
        $edit = "id='$_POST[editCustomer]' AND ";
    } else {
        $edit = "";
    }

    $xz = "SELECT * FROM tb_customer WHERE $edit rowstatus = 1";
    $response['data'] = array();
    $cari = mysqli_query($k, $xz);
    if (mysqli_num_rows($cari) > 0) {
        while ($data = mysqli_fetch_array($cari)) {
            $res["id"] = $data['id'];
            $res["nama_customer"] = $data['nama_customer'];
            $res["nomor_telp"] = $data['nomor_telp'];
            $res["alamat"] = $data['alamat'];

            array_push($response['data'], $res);
        }
        echo json_encode($response);

    } else {
        $response["code"] = "404";
        $response["message"] = "Error";

        echo json_encode($response);
    }
}

if (isset($_POST['add_customer'])) {
    $nama_customer = $_POST['nama_customer'];
    $nomor_telp = $_POST['nomor_telp'];
    $alamat = $_POST['alamat'];
    $edit_customer = $_POST['edit_customer'];

    if ($edit_customer > 0) {
        $upd = mysqli_query($k, "UPDATE tb_customer SET nama_customer='$nama_customer', nomor_telp='$nomor_telp', alamat='$alamat' WHERE id='$edit_customer'");
        if ($upd) {
            $response["code"] = "200";
            $response["message"] = "Berhasil Disimpan";
        } else {
            $response["code"] = "404";
            $response["message"] = "Gagal Disimpan";
        }
    } else {
        $qr = "SELECT * FROM tb_customer WHERE  nama_customer = '$nama_customer' AND rowstatus=1 ";
        $cekx = mysqli_query($k, $qr);
        if (mysqli_num_rows($cekx) <= 0) {
            $ins = mysqli_query($k, "INSERT INTO tb_customer (nama_customer,nomor_telp,alamat,rowstatus) VALUES ('$nama_customer','$nomor_telp','$alamat','1')");
            if ($ins) {
                $response["code"] = "200";
                $response["message"] = "Berhasil Disimpan";
            } else {
                $response["code"] = "404";
                $response["message"] = "Gagal Disimpan";
            }
        } else {
            $response["code"] = "300";
            $response["message"] = "Duplikat Data";
        }
    }
    echo json_encode($response);
}

if (isset($_POST['del_customer'])) {
    $id = $_POST['id'];
    $upd = mysqli_query($k, "UPDATE tb_customer SET rowstatus=0 WHERE id='$id'");

    if ($upd) {
        $response["code"] = "200";
        $response["message"] = "Berhasil Dihapus";
    } else {
        $response["code"] = "404";
        $response["message"] = "Gagal Dihapus";
    }

    echo json_encode($response);
}

// DRIVER
if (isset($_POST['data_sopir'])) {
    if (isset($_POST['editSopir'])) {
        $edit = "id='$_POST[editSopir]' AND ";
    } else {
        $edit = "";
    }
    $xz = "SELECT * FROM tb_sopir WHERE $edit rowstatus = 1";
    $response['data'] = array();
    $cari = mysqli_query($k, $xz);
    if (mysqli_num_rows($cari) > 0) {
        while ($data = mysqli_fetch_array($cari)) {
            $res["id"] = $data['id'];
            $res["nama_sopir"] = $data['nama_sopir'];
            $res["nomor_telp"] = $data['nomor_telp'];
            $res["nomor_polisi"] = $data['nomor_polisi'];

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
    $nama_sopir = $_POST['nama_sopir'];
    $nomor_telp = $_POST['nomor_telp'];
    $nomor_polisi = $_POST['nomor_polisi'];
    $edit_sopir = $_POST['edit_sopir'];

    if ($edit_sopir > 0) {
        $upd = mysqli_query($k, "UPDATE tb_sopir SET nama_sopir='$nama_sopir', nomor_telp='$nomor_telp', nomor_polisi='$nomor_polisi' WHERE id='$edit_sopir'");
        if ($upd) {
            $response["code"] = "200";
            $response["message"] = "Berhasil Disimpan";
        } else {
            $response["code"] = "404";
            $response["message"] = "Gagal Disimpan";
        }
    } else {
        $qr = "SELECT * FROM tb_sopir WHERE  nama_sopir = '$nama_sopir' AND nomor_telp='$nomor_telp' AND nomor_polisi='$nomor_polisi' AND rowstatus=1 ";
        $cekx = mysqli_query($k, $qr);
        if (mysqli_num_rows($cekx) <= 0) {
            $ins = mysqli_query($k, "INSERT INTO tb_sopir (nama_sopir,nomor_telp,nomor_polisi,rowstatus) VALUES ('$nama_sopir','$nomor_telp','$nomor_polisi','1')");
            if ($ins) {
                $response["code"] = "200";
                $response["message"] = "Berhasil Disimpan";
            } else {
                $response["code"] = "404";
                $response["message"] = "Gagal Disimpan";
            }
        } else {
            $response["code"] = "300";
            $response["message"] = "Duplikat Data";
        }
    }
    echo json_encode($response);
}

if (isset($_POST['del_sopir'])) {
    $id = $_POST['id'];
    $upd = mysqli_query($k, "UPDATE tb_sopir SET rowstatus=0 WHERE id='$id'");
    if ($upd) {
        $response["code"] = "200";
        $response["message"] = "Berhasil Dihapus";
    } else {
        $response["code"] = "404";
        $response["message"] = "Gagal Dihapus";
    }
    echo json_encode($response);
}
?>