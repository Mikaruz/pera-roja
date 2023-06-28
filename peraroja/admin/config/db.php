<?php
$server = "localhost";
$db = "peraroja";
$user = "root";
$password = "";

try {
    $conection = new PDO("mysql:host=$server;port=3307;dbname=$db", $user, $password);
} catch (Exception $ex) {
    echo $ex->getMessage();
}

$conexion = mysqli_connect("localhost", "root", "", "peraroja") or die("error de conexion");
