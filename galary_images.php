<?php
$directory = "gallery/images/";
$images = glob($directory . "*.{jpg,png,gif,jpeg}", GLOB_BRACE);

$imageUrls = array_map(function ($image) {
    return 'gallery/images/' . basename($image);
}, $images);

// Sort the image URLs in ascending order
sort($imageUrls);

// Encode the sorted image URLs into JSON
echo json_encode($imageUrls);
?>
