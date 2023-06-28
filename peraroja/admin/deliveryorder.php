<?php include('templates/header.php'); ?>

<?php
include("config/db.php");

$cancelid = $_GET['id'];
$sqlCancel = "UPDATE orders SET orderstatus = 'En camino' WHERE id = $cancelid";
mysqli_query($conexion, $sqlCancel);

header("Location:ordenesdb.php");
?>
