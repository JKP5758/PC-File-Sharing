<?php
session_start();

if (!isset($_SESSION['id'])) {
    echo "<script>location.href='login.php';</script>";
    exit;
}

require_once 'resize.php'; // Sertakan file resize.php

$dir = "img/";
$thumbDir = "thumbnails/"; // Direktori untuk menyimpan gambar thumbnail

// Mencari semua file dengan ekstensi tertentu (misalnya .jpg)
$files = glob($dir . "*.jpg");

// Membuat tabel virtual dalam memori
$fileTable = [];

// Memasukkan setiap nama file ke dalam tabel virtual
foreach ($files as $file) {
    $fileTable[] = basename($file);
}

// Membuat thumbnail jika belum ada
foreach ($fileTable as $file) {
    $source = $dir . $file;
    $destination = $thumbDir . $file;
    if (!file_exists($destination)) {
        resizeImage($source, $destination, 720, 720); // Mengubah ukuran gambar ke 200x200
        // atau menggunakan cropImage
        // cropImage($source, $destination, 200, 200); // Membuat thumbnail ukuran 200x200
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>PC File</title>
</head>
<body>
    <nav>
        <div class="logo"><img src="img/logo.png" alt="logo"></div>
        <div class="file">
            <span class="kategori">Wallpaper</span>
            <span class="kategori">Video</span>
        </div>
    </nav>
    <?php 
        require_once "conten.php";
    ?>
</body>
</html>
