<?php
// error_reporting(0);
include '../config/koneksi.php';
extract($_POST);
$query = mysqli_query($k, "SELECT * FROM conf_sistem a WHERE a.desc IN ('cam2','cam4')");

while ($cctv = mysqli_fetch_array($query)) {
  $file = $cctv['content'];
  $desc = $cctv['desc'];

  // Get today's date in YYYYMMDD format
  $today = date('Ymd');

  // Create the date-based folder path
  $folderPath = '../CCTV/car/' . $today;

  // Check if the folder exists, create it if not
  if (!is_dir($folderPath)) {
    mkdir($folderPath, 0777, true); // Create the folder and any necessary parent directories
  }

  $newfile = "$tiket-$type-$desc.jpeg";
  $locate = $folderPath . "/";
  $localFilePath = dirname(__DIR__) . "\\CCTV\\car\\" . $today . "\\" . $newfile;

  $login = explode(":", $cctv['notes'])[0];
  $password = explode(":", $cctv['notes'])[1];
  $url = $cctv['content'];

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
  curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");
  // Tidak menyimpan cache
  curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);

  $result = curl_exec($ch);
  curl_close($ch);

  $saveGbr = file_put_contents($localFilePath, $result);

  if ($saveGbr !== false) {
    $img = file_get_contents($locate . $newfile);
    if ($img === false) {
      echo "Failed to read the file contents.";
    } else {
      $real = dirname(__DIR__) . "\\CCTV\\car\\" . $today . "\\" . $newfile;
      $file = realpath($real);
      echo "Berhasil";
    }
  } else {
    echo "Gagal";
  }
}