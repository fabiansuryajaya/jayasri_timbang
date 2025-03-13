<?php
if (isset($_POST['image'])) {
    // Get the base64 image data
    $imageData = $_POST['image'];
    $tiket = $_POST['tiket'];

    // Get today's date in YYYYMMDD format
    $today = date('Ymd');

    // Create the date-based folder path
    $folderPath = '../LOG/' . $today;

    // Check if the folder exists, create it if not
    if (!is_dir($folderPath)) {
        mkdir($folderPath, 0777, true); // Create the folder and any necessary parent directories
    }

    // Remove the "data:image/jpeg;base64," prefix
    $imageData = str_replace('data:image/jpeg;base64,', '', $imageData);
    $imageData = str_replace(' ', '+', $imageData);

    // Decode the base64 string
    $decodedImage = base64_decode($imageData);

    // Create a unique filename
    $filename = $folderPath . '/' . $tiket . '-' . time() . '.jpg';

    // Save the image to the folder
    if (file_put_contents($filename, $decodedImage)) {
        echo $filename;
    } else {
        echo 'Error saving image.';
    }
} else {
    echo 'No image data received.';
}