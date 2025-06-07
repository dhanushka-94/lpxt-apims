<?php

// This script generates favicons of various sizes from an SVG file

// Path to the SVG file
$svgFile = __DIR__ . '/api-icon.svg';
$outputDir = __DIR__;

// Check if the SVG file exists
if (!file_exists($svgFile)) {
    die("Error: SVG file not found at $svgFile");
}

// Load SVG content
$svgContent = file_get_contents($svgFile);

// Create a temporary image from SVG
$im = new Imagick();
$im->readImageBlob($svgContent);

// Set background to transparent
$im->setBackgroundColor(new ImagickPixel('transparent'));

// Define favicon sizes
$sizes = [16, 32, 48, 64, 96, 128, 256];

// Generate PNGs in different sizes
foreach ($sizes as $size) {
    $clone = clone $im;
    $clone->resizeImage($size, $size, Imagick::FILTER_LANCZOS, 1);
    $clone->writeImage($outputDir . "/favicon-{$size}x{$size}.png");
    echo "Generated favicon-{$size}x{$size}.png\n";
}

// Generate favicon.ico with multiple sizes
$icon = new Imagick();
foreach ([16, 32, 48] as $size) {
    $clone = clone $im;
    $clone->resizeImage($size, $size, Imagick::FILTER_LANCZOS, 1);
    $icon->addImage($clone);
}
$icon->setFormat('ico');
$icon->writeImages($outputDir . '/favicon.ico', true);
echo "Generated favicon.ico with multiple sizes\n";

echo "Favicon generation complete!";
?> 