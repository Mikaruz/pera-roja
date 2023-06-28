<?php include("templates/header.php"); ?>

<?php
include("admin/config/db.php");

$customerid = $_SESSION['customerid'];
$sql = "SELECT * FROM orders WHERE userid='$customerid'";
$result = mysqli_query($conexion, $sql);


$sql2 = "SELECT * FROM users_data where userid = $customerid";
$result2 = mysqli_query($conexion, $sql2);
$row2 = mysqli_fetch_assoc($result2);

$sql3 = "SELECT * FROM users where id = $customerid";
$result3 = mysqli_query($conexion, $sql3);
$row3 = mysqli_fetch_assoc($result3);


?>

<h2 class="cart-title">Bienvenido <?php echo $row2["nombre"] ?></h2>
<div class="terminos-condiciones">
    <div class="cuenta">
        <div class="datos-personales">
            <h2>Datos personales</h2>
            <p><strong>Nombre: </strong> <?php echo $row2["nombre"] ?></p>
            <p><strong>Apellido: </strong> <?php echo $row2["apellido"] ?></p>
            <p><strong>Email: </strong> <?php echo $row3["email"] ?></p>
            <p><strong>Teléfono: </strong> <?php echo $row2["telefono"] ?></p>
            <p><strong>Distrito: </strong> <?php echo $row2["ciudad"] ?></p>
            <p><strong>Dirección: </strong> <?php echo $row2["direccion"] ?></p>
            <p><strong>Código postal: </strong> <?php echo $row2["postal"] ?></p>
        </div>

        <div class="cerrar-sesion">
            <a href="favoritos.php" class="btn-favoritos">Favoritos</a>
            <a href="calculadora.php" class="btn-calculadora">Calculadora</a>
            <a href="logout.php" class="btn-cerrar-sesion">Cerrar sesión</a>
        </div>
        
        <div class="historial-pedidos">
            <h2>Historial de pedidos</h2>
            <table>
                <thead>
                    <tr>
                        <th>Orden</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Total</th>

                    </tr>
                </thead>
                <tbody>
                    <?php


                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <tr>
                                <td>
                                    NO<?php echo $row["id"] ?>
                                </td>
                                <td>
                                    <?php echo date('M j g:i A', strtotime($row["timestamp"]));  ?>
                                </td>
                                <td>
                                    <?php echo $row["orderstatus"] ?>
                                </td>
                                <td>
                                    $<?php echo $row["totalprice"] ?>
                                </td>
                                <td>
                                    <a href="verOrden.php?id=<?php echo $row["id"]?>">Ver detalles</a>
                                </td>
                            </tr>


                    <?php
                        }
                    } else {
                        echo "0 results";
                    }


                    ?>


                </tbody>
            </table>
        </div>


    </div>



</div>


<?php include("templates/footer.php"); ?>