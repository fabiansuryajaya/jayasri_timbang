<?php
function processImage($inputPath, $outputPath, $cropX, $cropY, $cropWidth, $cropHeight)
{
    // Load the image
    $image = imagecreatefromjpeg($inputPath);
    if (!$image) {
        die("Failed to load image.");
    }
    $width = imagesx($image);
    $height = imagesy($image);
    $processedImage = imagecreatetruecolor($width, $height);
    imagefilter($image, IMG_FILTER_GRAYSCALE);
    imagefilter($image, IMG_FILTER_CONTRAST, -50);
    imagecopy($processedImage, $image, 0, 0, 0, 0, $width, $height);
    imagefilter($processedImage, IMG_FILTER_NEGATE);
    $croppedImage = imagecrop($processedImage, [
        'x' => $cropX,
        'y' => $cropY,
        'width' => $cropWidth,
        'height' => $cropHeight
    ]);

    if (!$croppedImage) {
        die("Failed to crop image.");
    }
    imagejpeg($croppedImage, $outputPath);
    imagedestroy($image);
    imagedestroy($processedImage);
    imagedestroy($croppedImage);

    // echo "Image processed successfully: $outputPath\n";
    return true;
}

// // Example usage
// $inputPath = "830.jpg"; // Path to your input image
// $outputPath = "830x.jpg"; // Path to save the processed image
// $cropX = 500; // X-coordinate of crop area
// $cropY = 350; // Y-coordinate of crop area
// $cropWidth = 800; // Width of crop area
// $cropHeight = 400; // Height of crop area

// processImage($inputPath, $outputPath, $cropX, $cropY, $cropWidth, $cropHeight);