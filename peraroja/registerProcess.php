<?php
include("templates/header.php");
// session_start();
include("admin/config/db.php");

if (isset($_POST['submit'])) {
  $email = mysqli_real_escape_string($conexion, $_POST['email']);
  $password =  password_hash($_POST['password'], PASSWORD_DEFAULT);
  //  $sql = "SELECT * FROM users WHERE email='$email' and password='$password'";

  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $telefono = $_POST['telefono'];
  $distrito = $_POST['distrito'];
  $direccion = $_POST['direccion'];
  $postal = $_POST['postal'];

  $sql = "INSERT INTO users (email, password ) VALUES ('$email', '$password' )";
  
  

  if (mysqli_query($conexion, $sql)) {
    $sql3 = "SELECT id FROM users WHERE email = '$email'";
   
    $_SESSION['customer'] = $email;
    $_SESSION['customerid'] = mysqli_insert_id($conexion);

    
    $resultado3 = mysqli_query($conexion, $sql3);

    $fila = mysqli_fetch_assoc($resultado3);
    $userid = $fila['id'];


    $sql2 = "INSERT INTO users_data (userid, nombre, apellido, ciudad, direccion, postal, telefono) VALUES ('$userid', '$nombre','$apellido', '$distrito', '$direccion', '$postal', '$telefono' )";
    mysqli_query($conexion, $sql2);
    header('location:index.php');
  } else {
    header('location:registerUser.php?message=2');
  }
}
