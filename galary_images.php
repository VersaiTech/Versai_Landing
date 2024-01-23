<?php
$directory = "gallery/images/";
$images = glob($directory . "*.{jpg,png,gif,jpeg}", GLOB_BRACE);

$imageUrls = array_map(function ($image) {
    return 'gallery/images/' . basename($image);
}, $images);

// Function to resize and compress an image
function resizeAndCompressImage($imagePath, $targetSizeKB) {
    $quality = 75; // Adjust the quality as needed

    list($width, $height) = getimagesize($imagePath);
    $aspectRatio = $width / $height;

    // Calculate new dimensions to maintain aspect ratio
    $newWidth = sqrt($targetSizeKB * 1024 * $aspectRatio);
    $newHeight = $newWidth / $aspectRatio;

    // Create a new image resource
    $resizedImage = imagecreatetruecolor($newWidth, $newHeight);

    // Load the original image
    $originalImage = imagecreatefromjpeg($imagePath); // Adjust for other image types

    // Resize the image
    imagecopyresampled($resizedImage, $originalImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

    // Save the resized and compressed image
    imagejpeg($resizedImage, $imagePath, $quality); // Adjust for other image types

    // Free up resources
    imagedestroy($resizedImage);
    imagedestroy($originalImage);
}

// Resize and compress each image in the directory
foreach ($images as $image) {
    resizeAndCompressImage($image, 200); // Target size in KB
}

// Sort the image URLs in ascending order
sort($imageUrls);

// Encode the sorted image URLs into JSON
echo json_encode($imageUrls);
?>
