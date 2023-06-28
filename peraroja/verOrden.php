<?php include("templates/header.php"); ?>

<?php
include("admin/config/db.php");

$customerid = $_SESSION['customerid'];

if (isset($_GET["id"])) {
    $orderid = $_GET["id"];
}

$sqlOrders = "SELECT * FROM orders WHERE id='$orderid' AND userid='$customerid'";
$resultOrders = mysqli_query($conexion, $sqlOrders);
$rowOrders = mysqli_fetch_assoc($resultOrders);

$sql = "SELECT * FROM ordersitems WHERE orderid='$orderid'";
$result = mysqli_query($conexion, $sql);

?>

<h2 class="cart-title">Orden NO<?php echo $rowOrders["id"] ?></h2>
<div class="terminos-condiciones">
    <div class="cuenta">
        <div class="historial-pedidos">
            <h2>Tu pedido:</h2>
            <table>
                <thead>
                    <tr>
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
                        <td><strong>$<?php echo  $rowOrders['totalprice'] ?></strong></td>
                    </tr>
                </tbody>
            </table>
            <h2>Detalles:</h2>
            <div class="datos-personales">

                <p><strong>Estado: </strong><?php echo  $rowOrders['orderstatus'] ?></p>
                <p><strong>Fecha: </strong> <?php echo date('M j g:i A', strtotime($rowOrders["timestamp"]));  ?></p>

            </div>
        </div>

        <?php

        if ($rowOrders['orderstatus'] != 'Cancelado') { ?>

            <div class="cerrar-sesion">
                <a href='cancel.php?id=<?php echo $rowOrders["id"]; ?>' class="btn-cerrar-sesion">Cancelar</a>
            </div>

        <?php } ?>




    </div>



</div>


<?php include("templates/footer.php"); ?>