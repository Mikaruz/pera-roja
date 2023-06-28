<?php
include("templates/header.php");
// session_start();
include("admin/config/db.php");

$userid = $_POST['userid'];
$idplato = $_POST['idplato'];
$review = $_POST['review'];

$sql2 = "INSERT INTO reviews (productid, userid, review) VALUES ('$idplato', '$userid','$review')";

mysqli_query($conexion, $sql2);
header("location: plato.php?id=$idplato");