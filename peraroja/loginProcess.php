<?php
include("templates/header.php");
session_start();
include("admin/config/db.php");

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conexion, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conexion, $sql);
    $row = mysqli_fetch_assoc($result);
    $dbStoredPASSWORD = $row['password'];


    if (password_verify($password, $dbStoredPASSWORD)) {
        $_SESSION['customer'] = $email;
        $_SESSION['customerid'] = $row['id'];
        header('location:cuenta.php');
    } else {
        header('location:loginUser.php?message=1');
        // $message =  'incorrect Credentials';
    }
}
