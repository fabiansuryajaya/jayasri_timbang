<?php
error_reporting(E_ALL);
include '../config/koneksi.php';
include 'indicator_converter.php';

extract($_POST);
$qr = mysqli_fetch_array(mysqli_query($k, "SELECT * FROM conf_sistem a WHERE a.desc='$cam'"));

$file = $qr['content'];
$newfile = "$tiket-$type-$cam.jpeg";

// Get today's date in YYYYMMDD format
$today = date('Ymd');

// Create the date-based folder path
$folderPath = '../CCTV/car/' . $today;

// Check if the folder exists, create it if not
if (!is_dir($folderPath)) {
  mkdir($folderPath, 0777, true); // Create the folder and any necessary parent directories
}

$locate = $folderPath . "/"; // Updated path with date-based folder
$localFilePath = dirname(__DIR__) . "\\CCTV\\car\\" . $today . "\\" . $newfile;

$login = explode(":", $qr['notes'])[0];
$password = explode(":", $qr['notes'])[1];
$url = $qr['content'];

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
  $img = file_get_contents($locate . $newfile); // Updated path with date-based folder

  if ($img === false) {
    echo "Failed to read the file contents.";
  } else {
    // Prepare for upload with cURL
    $real = $localFilePath; // Updated path with date-based folder

    // Pengolahan Gambar
    $inputPath = $real; // Path to your input image
    $outputPath = "indicator.jpg"; // Path to save the processed image
    $cropX = 620; // X-coordinate of crop area
    $cropY = 400; // Y-coordinate of crop area
    $cropWidth = 800; // Width of crop area
    $cropHeight = 200; // Height of crop area

    if (processImage($inputPath, $outputPath, $cropX, $cropY, $cropWidth, $cropHeight)) {
      $cFile = curl_file_create($outputPath) ?: '@' . $outputPath; // Handle PHP version differences

      $data = [
        'upload' => $cFile,
        'regions' => 'us-ca', // Optional region parameter
      ];

      $ch = curl_init('https://api.platerecognizer.com/v1/plate-reader/');

      $tokenKey = ["1678f1e1c65dadd323574264720b8ecb414b9a97"];
      $randomKey = array_rand($tokenKey);
      $randomToken = $tokenKey[$randomKey];

      curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2TLS,
        CURLOPT_HTTPHEADER => [
          "Authorization: Token $randomToken",
        ],
      ]);

      $result = curl_exec($ch);
      echo $result;
      curl_close($ch);
      exit;
    }
  }
} else {
  echo "Gagal";
}