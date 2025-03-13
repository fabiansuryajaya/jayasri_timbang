<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include '../Config/koneksi.php';
include '../Config/fungsi.php';

if (isset($_POST['log'])) {
  $user = anti($_POST['user']);
  $pass = substr(sha1(anti($_POST['password'])), 0, 15);
  $xz = "SELECT * FROM tb_user WHERE aktif=1 AND username = '$user' AND password = '$pass'";
  $response = array();
  $cari = mysqli_query($k, $xz);
  if (mysqli_num_rows($cari) > 0) {
    $x = mysqli_fetch_array($cari);
    mysqli_query($k, "UPDATE tb_login SET last_login=NOW() WHERE id='$x[id]'");
    $response["code"] = "201";
    $response["message"] = "Login Berhasil";
    $response['id_user'] = $x["id"];
    $response['nama_user'] = $x["nama_user"];
    $response['level'] = $x["level"];
    echo json_encode($response);
  } else {
    $response["code"] = "404";
    $response["message"] = "User dan password tidak ditemukan.";
    echo json_encode($response);
  }
}