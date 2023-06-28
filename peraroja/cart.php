<?php include("templates/header.php"); ?>
<?php

$cart = $_SESSION['cart'];


include("admin/config/db.php");
$sentenceSQL = $conection->prepare("SELECT * FROM platos");
$sentenceSQL->execute();
$platoList = $sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<h2 class="cart-title">Carrito</h2>
<div class="container">
    <table>
        <thead>
            <tr>
                <th>Plato</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            foreach ($cart as $key => $value) {

                $sql = "SELECT * FROM platos where id = $key";
                $resultado = mysqli_query($conexion, $sql);

                $row = mysqli_fetch_assoc($resultado)
            ?>


                <tr>
                    <td><a href="plato.php?id=<?php echo $row['id'] ?>"><img src="images/platosdb/<?php echo $row['imagen'] ?>" alt="" width="250"></a></td>
                    <td><?php echo $row['nombre'] ?></a></td>
                    <td>$<?php echo $row['precio'] ?> </td>
                    <td><?php echo $value['quantity'] ?></td>
                    <td><?php echo $row['precio'] * $value['quantity'] ?> </td>
                    <td><a class="remover-btn" href='deleteCart.php?id=<?php echo $key; ?>'>Remover</a></td>
                </tr>

            <?php

                $total = $total +  ($row['precio'] * $value['quantity']);
            }

            ?>
        </tbody>
    </table>
    <div class="total">
        <span class="total-label">Total:</span>
        <span class="total-price">$<?php echo $total; ?></span>

    </div>

    <a href="pago.php" class="pagar-btn">Pagar</a>
</div>




<?php include("templates/footer.php"); ?>