<?php

include("templates/header.php");
session_start();
include("admin/config/db.php");

$cancelid = $_GET['id'];
$sqlCancel = "UPDATE orders SET orderstatus = 'Cancelado' WHERE id = $cancelid";
mysqli_query($conexion, $sqlCancel);

header('location:cuenta.php')

?>