<?php
include("templates/header.php");
// session_start();
include("admin/config/db.php");

if (isset($_GET["id"])) {
    $platoid = $_GET["id"];
}
$customerid =$_SESSION['customerid'];
$sql = "INSERT INTO favoritos (productid, userid) VALUES ('$platoid', '$customerid')";

mysqli_query($conexion, $sql);
header("location: favoritos.php");