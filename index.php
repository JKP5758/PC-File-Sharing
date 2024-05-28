<?php
session_start();

if (!isset($_SESSION['id'])) {
    echo "<script>location.href='login.php';</script>";
} else {
    echo "<script>location.href='view.php;</script>";
}
