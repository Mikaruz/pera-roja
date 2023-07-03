<?php include("templates/header.php");


$customerid = $_SESSION['customerid'];

$sqlOrders = "SELECT * FROM orders WHERE userid='$customerid' AND DATE(timestamp) = CURDATE()";
$resultOrders = mysqli_query($conexion, $sqlOrders);

$sql2 = "SELECT * FROM users_data where userid = $customerid";
$result2 = mysqli_query($conexion, $sql2);
$row2 = mysqli_fetch_assoc($result2);







// Pedir los datos al usuario

$sexo = $row2["genero"];


switch ($sexo) {
    case '1':
        $sexo = 'hombre';
        break;
    case '2':
        $sexo = 'mujer';
        break;
    default:
        echo "error1";
        break;
}

$peso = $row2["peso"];
$altura = $row2["altura"];
$edad = $row2["edad"];

$MB = 0;

$nivelActividad = $row2["nivel"];

switch ($nivelActividad) {
    case '1':
        $nivelActividad = "sedentario";
        break;
    case '2':
        $nivelActividad = "ligero";
        break;
    case '3':
        $nivelActividad = "moderado";
        break;
    case '4':
        $nivelActividad = "intenso";
        break;
    case '5':
        $nivelActividad = "activo";
        break;
    default:
        echo "error2";
        break;
}

// Calcular el metabolismo basal (MB) según el sexo
if ($sexo == "hombre") {
    $MB = 10 * $peso + 6.25 * $altura - 5 * $edad + 5;
} elseif ($sexo == "mujer") {
    $MB = 10 * $peso + 6.25 * $altura - 5 * $edad - 161;
}

// Calcular las calorías necesarias según el nivel de actividad física
if ($nivelActividad == "sedentario") {
    $calorias = $MB * 1.2;
} elseif ($nivelActividad == "ligero") {
    $calorias = $MB * 1.375;
} elseif ($nivelActividad == "moderado") {
    $calorias = $MB * 1.55;
} elseif ($nivelActividad == "intenso") {
    $calorias = $MB * 1.725;
} elseif ($nivelActividad == "muy activo") {
    $calorias = $MB * 1.9;
}

// Mostrar el resultado





?>
<h2 class="cart-title">Calculadora de calorías diarias</h2>
<div class="terminos-condiciones">
    <div class="historial-pedidos">
        <h2>¡Necesitas consumir <?php echo $calorias?>kcal al día!</h2>
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

                                $totalCalorias += $rowProduct["calorias"] * $row["quantity"];
                                $totalProteinas += $rowProduct["proteinas"] * $row["quantity"];
                                $totalCarbohidratos += $rowProduct["carbohidratos"] * $row["quantity"];
                                $totalGrasas += $rowProduct["grasas"] * $row["quantity"];
                ?>


                                <tr>
                                    <td>
                                        <?php echo $row["quantity"] ?> <?php echo $rowProduct["nombre"] ?>
                                    </td>
                                    <td>
                                        <?php echo $rowProduct["calorias"] * $row["quantity"]; ?>kcal
                                    </td>
                                    <td>
                                        <?php echo $rowProduct["proteinas"] * $row["quantity"]; ?>g
                                    </td>
                                    <td>
                                        <?php echo $rowProduct["carbohidratos"] * $row["quantity"]; ?>g
                                    </td>
                                    <td>
                                        <?php echo $rowProduct["grasas"] * $row["quantity"]; ?>g
                                    </td>
                                </tr>





                <?php }
                        }
                    }
                } else {
                    echo "0 results";
                }



                ?>





            </tbody>
            <tfoot>
                <tr>
                    <th>Total</th>
                    <th><?php echo $totalCalorias ?>kcal</th>
                    <th><?php echo $totalProteinas ?>g</th>
                    <th><?php echo $totalCarbohidratos ?>g</th>
                    <th><?php echo $totalGrasas ?>g</th>
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