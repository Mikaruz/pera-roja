<?php include("templates/header.php");

$customerid = $_SESSION['customerid'];

$sqlOrders = "SELECT * FROM orders WHERE userid='$customerid' AND DATE(timestamp) = CURDATE()";
$resultOrders = mysqli_query($conexion, $sqlOrders);







?>
<h2 class="cart-title">Calculadora de calorías diarias</h2>
<div class="terminos-condiciones">
    <div class="historial-pedidos">
        <h2>Calculadora de calorías</h2>
        <table>
            <thead>
                <tr>
                    <th>Plato</th>
                    <th>Calorías</th>
                    <th>Proteínas</th>
                    <th>Carbohidratos</th>
                    <th>Grasas</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $totalCalorias = 0;
                $totalProteinas = 0;
                $totalCarbohidratos = 0;
                $totalGrasas = 0;
                if (mysqli_num_rows($resultOrders) > 0) {
                    while ($row = mysqli_fetch_assoc($resultOrders)) {
                        $orderid = $row["id"];
                        $sql = "SELECT * FROM ordersitems WHERE orderid='$orderid'";
                        $result = mysqli_query($conexion, $sql);

                        if (mysqli_num_rows($result) > 0) {

                            while ($row = mysqli_fetch_assoc($result)) {
                                $productid = $row["productid"];

                                $sqlProduct = "SELECT * FROM platos WHERE id='$productid'";
                                $resultProduct = mysqli_query($conexion, $sqlProduct);

                                $rowProduct = mysqli_fetch_assoc($resultProduct);
                                
                                $totalCalorias += $rowProduct["calorias"];
                                $totalProteinas += $rowProduct["proteinas"];
                                $totalCarbohidratos += $rowProduct["carbohidratos"];
                                $totalGrasas += $rowProduct["grasas"];
                ?>


                                <tr>
                                    <td>
                                        <?php echo $rowProduct["nombre"] ?>
                                    </td>
                                    <td>
                                    <?php echo $rowProduct["calorias"] ?>
                                    </td>
                                    <td>
                                    <?php echo $rowProduct["proteinas"] ?>
                                    </td>
                                    <td>
                                    <?php echo $rowProduct["carbohidratos"] ?>
                                    </td>
                                    <td>
                                    <?php echo $rowProduct["grasas"] ?>
                                    </td>
                                </tr>





                <?php }
                        }
                    }
                }else{
                    echo "0 results";
                }



                ?>





            </tbody>
            <tfoot>
        <tr>
            <th>Total</th>
            <th><?php echo $totalCalorias ?></th>
            <th><?php echo $totalProteinas ?></th>
            <th><?php echo $totalCarbohidratos ?></th>
            <th><?php echo $totalGrasas ?></th>
        </tr>
    </tfoot>
        </table>
    </div>

</div>
<iframe width="560" height="315" src="https://www.youtube.com/embed/C0dO40m_HQw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
<iframe width="560" height="315" src="https://www.youtube.com/embed/WnoCFnIiQHw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/main.js"></script>




<?php include("templates/footer.php"); ?>