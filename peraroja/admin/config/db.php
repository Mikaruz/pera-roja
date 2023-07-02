<?php
$server = "localhost";
$db = "peraroja";
$user = "root";
$password = "";

try {
    $conection = new PDO("mysql:host=$server;port=3306;dbname=$db", $user, $password);
} catch (Exception $ex) {
    echo $ex->getMessage();
}

$conexion = mysqli_connect("localhost:3306", "root", "", "peraroja") or die("error de conexion");
