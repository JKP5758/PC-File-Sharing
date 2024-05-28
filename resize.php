<?php

function resizeImage($source, $destination, $maxWidth, $maxHeight, $scale = 1.0) {
    // Mendapatkan informasi gambar
    $imageInfo = getimagesize($source);

    // Memeriksa apakah fungsi getimagesize berhasil
    if (!$imageInfo) {
        return false;
    }

    list($srcWidth, $srcHeight, $type) = $imageInfo;

    // Membuat gambar sumber
    switch ($type) {
        case IMAGETYPE_JPEG:
            $srcImage = imagecreatefromjpeg($source);
            break;
        case IMAGETYPE_PNG:
            $srcImage = imagecreatefrompng($source);
            break;
        case IMAGETYPE_GIF:
            $srcImage = imagecreatefromgif($source);
            break;
        default:
            return false;
    }

    // Memeriksa apakah skala valid
    if ($scale <= 0 || $scale > 1) {
        return false;
    }

    // Menghitung dimensi baru
    $srcWidth *= $scale;
    $srcHeight *= $scale;
    $aspectRatio = $srcWidth / $srcHeight;

    if ($srcWidth <= $maxWidth && $srcHeight <= $maxHeight) {
        $newWidth = $srcWidth;
        $newHeight = $srcHeight;
    } elseif ($maxWidth / $maxHeight > $aspectRatio) {
        $newWidth = $maxHeight * $aspectRatio;
        $newHeight = $maxHeight;
    } else {
        $newWidth = $maxWidth;
        $newHeight = $maxWidth / $aspectRatio;
    }

    // Membuat gambar tujuan
    $dstImage = imagecreatetruecolor($newWidth, $newHeight);

    // Meresample gambar
    imagecopyresampled($dstImage, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $srcWidth, $srcHeight);

    // Menyimpan gambar tujuan
    switch ($type) {
        case IMAGETYPE_JPEG:
            imagejpeg($dstImage, $destination);
            break;
        case IMAGETYPE_PNG:
            // Menyimpan gambar PNG dengan kualitas maksimum untuk menghindari peringatan
            imagepng($dstImage, $destination);
            break;
        case IMAGETYPE_GIF:
            imagegif($dstImage, $destination);
            break;
    }

    // Menghapus gambar sumber dan tujuan
    imagedestroy($srcImage);
    imagedestroy($dstImage);

    return true;
}

?>
