<?php include('templates/header.php'); ?>

<?php
include("config/db.php");

if (isset($_GET["id"])) {
    $orderid = $_GET["id"];
}



$sqlOrders = "SELECT * FROM orders WHERE id='$orderid'";
$resultOrders = mysqli_query($conexion, $sqlOrders);
$rowOrders = mysqli_fetch_assoc($resultOrders);

$sql = "SELECT * FROM ordersitems WHERE orderid='$orderid'";
$result = mysqli_query($conexion, $sql);

?>

<h2 class="title">Orden NO<?php echo $rowOrders["id"] ?></h2>

<div class="container">
    <div class="platos-container">
        <div class="data-table-order">
            <table>
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Plato</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php


                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            $productid = $row["productid"]
                    ?>
                            <tr>
                                <td>

                                    <?php

                                    $sqlProduct = "SELECT * FROM platos WHERE id='$productid'";
                                    $resultProduct = mysqli_query($conexion, $sqlProduct);

                                    $rowProduct = mysqli_fetch_assoc($resultProduct);



                                    ?>
                                    <img class="img-thumbnail rounded" src="../images/platosdb/<?php echo $rowProduct['imagen']; ?>" width="100" alt="">

                                </td>
                                <td>

                                    <?php echo $rowProduct["nombre"] ?>
                                </td>

                                <td>
                                    <?php echo $row["quantity"] ?>
                                </td>
                                <td>
                                    $<?php echo $row["productprice"] ?>
                                </td>
                                <td>
                                    $<?php echo $row["quantity"] * $row["productprice"] ?>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "0 results";
                    }
                    ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><strong>$<?php echo  $rowOrders['totalprice'] ?></strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="button-container">
        <a href="completeorder.php?id=<?php echo $rowOrders["id"]; ?>" class="btn-agregar">Pedido completado</a>
        <a href="deliveryorder.php?id=<?php echo $rowOrders["id"]; ?>" class="btn-modificar">En camino</a>
        <a href="cancelorder.php?id=<?php echo $rowOrders["id"]; ?>" class="btn-cancelar">Cancelar pedido</a>
    </div>
</div>