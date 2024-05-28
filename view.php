<?php
session_start();

if (!isset($_SESSION['id'])) {
    echo "<script>location.href='login.php';</script>";
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
        require_once "conten.php"
    ?>
</body>
</html>