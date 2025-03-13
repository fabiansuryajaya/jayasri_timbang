<?php
error_reporting(0);
include '../Config/koneksi.php';

extract($_POST);
$qr = mysqli_fetch_array(mysqli_query($k, "SELECT * FROM conf_sistem a WHERE a.desc='$cam'"));

$file = $qr['content'];
echo $file;
$newfile = "$tiket-$type-$cam.jpeg";
$locate = '../CCTV/car/';
chmod($locate, 0777);
chmod(dirname(__DIR__) . "\\CCTV\\car\\", 0777);

$imageData = file_get_contents($file);

$localFilePath = dirname(__DIR__) . "\\CCTV\\car\\123" . $newfile;
file_put_contents($localFilePath, $imageData);


if (!copy($file, $locate . $newfile)) {

  echo "Gagal";
} else {
  $img = file_get_contents($locate . $newfile);
  if ($img === false) {
    echo "Failed to read the file contents.";
  } else {
    // echo "File saved and contents read successfully.";
    // CREATE FILE READY TO UPLOAD WITH CURL

    $real = dirname(__DIR__) . "\\CCTV\\car\\" . $newfile;
    $file = realpath($real);
    if (function_exists('curl_file_create')) { // php 5.5+
      $cFile = curl_file_create($file);
    } else {
      $cFile = '@' . realpath($file);
    }
    //ADD PARAMETER IN REQUEST LIKE regions
    $data = array(
      'upload' => $cFile,
      'regions' => 'us-ca' // Optional
    );

    // Prepare new cURL resource
    $ch = curl_init('https://api.platerecognizer.com/v1/plate-reader/');
    $tokenKey = ["1678f1e1c65dadd323574264720b8ecb414b9a97", "48092c8124cbe89cfa8f0412532163eb520c7cc8", "13805da312d0f9c3fe8dd1c31f7608607a6ab934"]; //aldysetiaa,awebalizer,teamsijawara
    $randomKey = array_rand($tokenKey);
    $randomToken = $tokenKey[$randomKey];
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_2TLS);

    // Set HTTP Header for POST request
    curl_setopt(
      $ch,
      CURLOPT_HTTPHEADER,
      array(
        "Authorization: Token $randomToken"  //API KEY
      )
    );

    // Submit the POST request and close cURL session handle
    $result = curl_exec($ch);
    echo ($result);
    exit;
    curl_close($ch);
  }
}