<?php
function resizeImage($source, $destination, $maxWidth, $maxHeight, $scale = 1.0) {
    list($srcWidth, $srcHeight, $type) = getimagesize($source);

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

    // Check if scale is provided and adjust dimensions accordingly
    if ($scale !== 1.0) {
        $srcWidth *= $scale;
        $srcHeight *= $scale;
    }

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

    $dstImage = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($dstImage, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $srcWidth, $srcHeight);

    switch ($type) {
        case IMAGETYPE_JPEG:
            imagejpeg($dstImage, $destination);
            break;
        case IMAGETYPE_PNG:
            imagepng($dstImage, $destination);
            break;
        case IMAGETYPE_GIF:
            imagegif($dstImage, $destination);
            break;
    }

    imagedestroy($srcImage);
    imagedestroy($dstImage);

    return true;
}
?>
