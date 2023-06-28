<?php include("templates/header.php"); ?>

<?php
include("admin/config/db.php");

$customerid = $_SESSION['customerid'];

if (isset($_GET["id"])) {
    $orderid = $_GET["id"];
}

$sql = "SELECT * FROM favoritos WHERE userid='$customerid'";
$result = mysqli_query($conexion, $sql);


?>


<h2 class="cart-title">Favoritos</h2>
<div class="terminos-condiciones">
    <div class="cuenta">
        <div class="historial-pedidos">
            <table>
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php


                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            
                    ?>
                            <tr>
                                <td>
                                    <?php 
                                    $platoid =  $row['productid'];
                                    $sql2 = "SELECT * FROM platos WHERE id=$platoid";
                                    $result2 = mysqli_query($conexion, $sql2);
                                    $row2 = mysqli_fetch_assoc($result2);
                                    ?>
                                    <a href="plato.php?id=<?php echo $row2['id'] ?>"><img src="images/platosdb/<?php echo $row2['imagen'] ?>" alt="" width="100"></a>
                                </td>
                                <td>
                                    <p><?php echo $row2['nombre']; ?></p>
                                </td>
                                <td>
                                    <a href="cancelfav.php?id=<?php echo $row["id"] ?>">Borrar</a>
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