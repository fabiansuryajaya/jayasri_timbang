<?php
error_reporting(0);
header('Content-Type: application/json');

header('Access-Control-Allow-Origin: *');

include '../connect.php';


if (isset($_GET['record'])) {
  $xz = "SELECT max(id)+1 as id from tb_weighing_scale where rowstatus=1";
  $response = array();
  $cari = mysqli_query($k, $xz);
  if (mysqli_num_rows($cari) > 0) {
    $data = mysqli_fetch_array($cari);
    $response["tiket"] = $data['id'];

    echo json_encode($response);
  } else {
    $response["code"] = "404";
    $response["message"] = "Error";

    echo json_encode($response);

  }
}

if (isset($_POST['save_hasil'])) {
  $tiket = $_POST['tiket'];
  $tara = str_replace(" ", "", $_POST['tara']);
  $material = $_POST['material'];
  $kendaraan = $_POST['kendaraan'];
  $pengemudi = $_POST['pengemudi'];
  $nama_user = $_POST['nama_user'];

  $ins = mysqli_query($k, "INSERT INTO `tb_weighing_scale` (`no_record`,`id_mobil`, `id_driver`, `tgl_masuk`,  `tara`,  `createdby`, `createdon`, `rowstatus`, `remark`) VALUES ('$tiket','$kendaraan', '$pengemudi', NOW(),  '$tara',  '$nama_user', NOW(), '1', '$material')");
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
  $bruto = str_replace(" ", "", $_POST['bruto']);
  $netto = str_replace(" ", "", $_POST['netto']);
  $tiket = $_POST['tiket'];
  $id = $_POST['id'];

  $ins = mysqli_query($k, "UPDATE  `tb_weighing_scale` SET   `bruto` = '$bruto', `netto` = '$netto'  WHERE `id` = '$id'");
  if ($ins) {

    $response["code"] = "200";
    $response["message"] = "Berhasil Disimpan";
  } else {
    $response["code"] = "404";
    $response["message"] = "Error";
  }
  echo json_encode($response);

}


if (isset($_POST['load_table'])) {
  $xz = "SELECT a.*, b.`nomor_polisi`,c.`nama_dtl` FROM tb_weighing_scale a LEFT JOIN tb_tank_lorry b ON a.`id_mobil`=b.`id` LEFT JOIN tb_driver_tl c ON a.`id_driver`=c.`id` WHERE  (a.netto <= 0 OR a.`netto` IS NULL) AND (a.bruto <= 0 OR a.`bruto` IS NULL) AND ( a.id_mobil!=0 OR a.id_driver!=0) 
     AND DATEDIFF(DATE(NOW()), a.`createdon`) <= 5 ORDER BY a.tgl_masuk ASC";
  $response['data'] = array();
  $cari = mysqli_query($k, $xz);
  if (mysqli_num_rows($cari) > 0) {
    while ($data = mysqli_fetch_array($cari)) {
      $res["id"] = $data['id'];
      $res["tiket"] = $data['id'];
      $res["pengemudi"] = $data['nama_dtl'];
      $res["kendaraan"] = $data['nomor_polisi'];
      $res["tgl"] = $data['tgl_masuk'];
      $res["tara"] = number_format((float) $data['tara']);
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
  $xz = "SELECT a.*, b.`nomor_polisi`, b.`status_tank`, b.`kode_tank`, c.`nama_dtl` FROM tb_weighing_scale a LEFT JOIN tb_tank_lorry b ON a.`id_mobil` = b.`id` LEFT JOIN  tb_driver_tl c ON a.`id_driver` = c.`id` WHERE a.id = '$_POST[kodeLama]' AND (a.netto <= 0 OR a.`netto` IS NULL) AND (a.bruto <= 0 OR a.`bruto` IS NULL) AND (a.id_mobil != 0 OR a.id_driver != 0) ORDER BY a.tgl_masuk ASC";
  $res = array();
  $cari = mysqli_query($k, $xz);
  if (mysqli_num_rows($cari) > 0) {
    $data = mysqli_fetch_array($cari);
    $res["id"] = $data['id'];
    $res["tiket"] = $data['id'];
    $res["pengemudi"] = $data['nama_dtl'];
    $res["kendaraan"] = $data['nomor_polisi'];
    $res["material"] = $data['remark'];
    $res["tgl"] = $data['tgl_masuk'];
    $res["tara"] = str_replace(" ", "", $data['tara']);
    $res["nama_user"] = $data['createdby'];

    echo json_encode($res);
  } else {
    $response["code"] = "404";
    $response["message"] = "Error";

    echo json_encode($response);

  }
}

?>