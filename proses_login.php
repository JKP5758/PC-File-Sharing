<?php
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$envVars = parse_ini_file('.env');

if ($username == $envVars['user'] && $password == $envVars['pw']) {
    $_SESSION['id'] = "001";
    header("location: view.php");
} else {
    echo "<script> alert('Username / Password Salah'); window.location.href = 'login.php';</script> ";
}

?>