<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include '../Config/koneksi.php';
include '../Config/fungsi.php';

if (isset($_GET['record'])) {
  $xz = "SELECT id, IF(tiket!='',CONCAT('WB',SUBSTRING_INDEX(tiket,'B',-1)+1),CONCAT('WB',1)) AS nomor  FROM tb_weighing_scale ORDER by id desc LIMIT 1;";
  $response = array();
  $cari = mysqli_query($k, $xz);
  if (mysqli_num_rows($cari) > 0) {
    $data = mysqli_fetch_array($cari);
    $response["tiket"] = $data['nomor'];

    echo json_encode($response);
  } else {
    $response["code"] = "404";
    $response["message"] = "Error";

    echo json_encode($response);
  }
}

if (isset($_POST['save_hasil'])) {
  $tiket = $_POST['tiket'];
  $tara = $_POST['tara'];
  $material = $_POST['material'];
  $kendaraan = $_POST['kendaraan'];
  $pengemudi = $_POST['pengemudi'];
  $asal = $_POST['asal'];
  $tujuan = $_POST['tujuan'];
  $catatan = $_POST['catatan'];
  $nama_user = $_POST['nama_user'];

  $ins = mysqli_query($k, "INSERT INTO `tb_weighing_scale` (`tiket`,`kendaraan`, `pengemudi`, `tgl_masuk`,  `asal`, `tujuan`, `material`, `tara`, `catatan`, `createdby`, `createdon`, `rowstatus`) VALUES ('$tiket','$kendaraan', '$pengemudi', NOW(),  '$asal', '$tujuan', '$material', '$tara',  '$catatan', '$nama_user', NOW(), '1')");
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
  $bruto = $_POST['bruto'];
  $netto = $_POST['netto'];
  $tglkeluar = $_POST['tglkeluar'];
  $tiket = $_POST['tiket'];
  $id = $_POST['id'];

  // $cekKodeSurat = mysqli_fetch_array(mysqli_query($k,"SELECT  b.`kode_surat`, a.`asal` FROM tb_weighing_scale a LEFT JOIN tb_asal b ON a.`asal`=b.`asal` WHERE a.`id`='$id'"));
  $kodeAsal = "HTR"; // $cekKodeSurat['kode_surat'];
  $bln = date('m');
  $tahun = date('Y');
  $cekSuratTerakhir = mysqli_fetch_array(mysqli_query($k, "SELECT MAX(nomor_surat) AS nomor_surat,SUBSTRING_INDEX(MAX(nomor_surat),'/',1) tktLast, IF(SUBSTRING_INDEX(MAX(nomor_surat),'/',1)  IS NULL,'001',LPAD(SUBSTRING_INDEX(MAX(nomor_surat),'/',1)+1,3,0)) AS nomor, CONCAT('/$kodeAsal/','$bln','/','$tahun') AS kop FROM tb_weighing_scale WHERE nomor_surat LIKE '%/$kodeAsal/$bln/$tahun' AND rowstatus  = 1"));
  $nomorBaru = $cekSuratTerakhir['nomor'] . $cekSuratTerakhir['kop'];

  $ins = mysqli_query($k, "UPDATE  `tb_weighing_scale` SET  `nomor_surat`='$nomorBaru',  `tgl_keluar` = '$tglkeluar',   `bruto` = '$bruto', `netto` = '$netto'  WHERE `id` = '$id'");
  if ($ins) {
    $response["code"] = "200";
    $response["message"] = "$nomorBaru Berhasil Disimpan";
  } else {
    $response["code"] = "404";
    $response["message"] = "Error";
  }
  echo json_encode($response);
}

if (isset($_POST['load_table'])) {
  $xz = "SELECT id,tiket,kendaraan,pengemudi, tgl_masuk  as tgl, tujuan, tara FROM tb_weighing_scale WHERE (bruto IS NULL OR bruto='') AND rowstatus=1 ORDER BY id DESC";
  $response['data'] = array();
  $cari = mysqli_query($k, $xz);
  if (mysqli_num_rows($cari) > 0) {
    while ($data = mysqli_fetch_array($cari)) {
      $res["id"] = $data['id'];
      $res["tiket"] = $data['tiket'];
      $res["pengemudi"] = $data['pengemudi'];
      $res["kendaraan"] = $data['kendaraan'];
      $res["tujuan"] = $data['tujuan'];
      $res["tgl"] = $data['tgl'];
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

if (isset($_POST['load_table_transaksi'])) {
  $xz = "SELECT * FROM tb_weighing_scale WHERE netto > 0 AND rowstatus=1 ORDER BY id DESC";
  $response['data'] = array();
  $cari = mysqli_query($k, $xz);
  if (mysqli_num_rows($cari) > 0) {
    while ($data = mysqli_fetch_array($cari)) {
      $res["id"] = $data['id'];
      $res["tiket"] = $data['tiket'];
      $res["nomor_surat"] = $data['nomor_surat'];
      $res["pengemudi"] = $data['pengemudi'];
      $res["kendaraan"] = $data['kendaraan'];
      $res["tujuan"] = $data['tujuan'];
      $res["catatan"] = $data['catatan'];
      $res["tgl"] = tgl_miring($data['tgl_masuk']);
      $res["tara"] = number_format((float) $data['tara']);
      $res["bruto"] = number_format((float) $data['bruto']);
      $res["netto"] = number_format((float) $data['netto']);
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
  $xz = "SELECT * FROM tb_weighing_scale WHERE tiket='$_POST[kodeLama]'";
  $res = array();
  $cari = mysqli_query($k, $xz);
  if (mysqli_num_rows($cari) > 0) {
    $data = mysqli_fetch_array($cari);
    $res["id"] = $data['id'];
    $res["tiket"] = $data['tiket'];
    $res["pengemudi"] = $data['pengemudi'];
    $res["kendaraan"] = $data['kendaraan'];
    $res["asal"] = $data['asal'];
    $res["tujuan"] = $data['tujuan'];
    $res["material"] = $data['material'];
    $res["tgl"] = $data['tgl_masuk'];
    $res["tara"] = $data['tara'];
    $res["catatan"] = $data['catatan'];
    $res["nama_user"] = $data['createdby'];
    echo json_encode($res);
  } else {
    $response["code"] = "404";
    $response["message"] = "Error";
    echo json_encode($response);
  }
}