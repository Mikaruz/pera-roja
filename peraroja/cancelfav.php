<?php

include("templates/header.php");
include("admin/config/db.php");

$cancelid = $_GET['id'];
$sqlCancel = "DELETE FROM favoritos WHERE id = $cancelid;";
mysqli_query($conexion, $sqlCancel);

header('location:favoritos.php');

?>