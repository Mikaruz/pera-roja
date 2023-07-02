<?php

include("templates/header.php");
include("admin/config/db.php");


include("admin/config/db.php");
if (!isset($_SESSION['customer']) && empty($_SESSION['customer'])) {
    header('location:loginUser.php');
}

$_POST['agree'] = 'false';

if (isset($_SESSION['cart'])) {
    $total = 0;
    foreach ($cart as $key => $value) {
        // echo $key ." : ". $value['quantity'] . "<br>";

        $sql_cart = "SELECT * FROM platos where id = $key";
        $result_cart = mysqli_query($conexion, $sql_cart);
        $row_cart = mysqli_fetch_assoc($result_cart);
        $total = $total +  ($row_cart['precio'] * $value['quantity']);
    }
}


if (isset($_POST['submit'])) {
    if ($_POST['agree'] == true) {


        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $telefono = $_POST['telefono'];
        $ciudad = $_POST['ciudad'];
        $direccion = $_POST['direccion'];
        $postal = $_POST['postal'];
        $payment = $_POST['payment'];
        $agree = $_POST['agree'];
        $customerid = $_SESSION['customerid'];

        $sql = "SELECT * FROM users_data WHERE userid = $customerid";
        $result = mysqli_query($conexion, $sql);
        $row = mysqli_fetch_assoc($result);

        if (mysqli_num_rows($result) == 1) {
            $up_sql = "UPDATE users_data SET nombre='$nombre', apellido='$apellido', telefono='$telefono', ciudad='$ciudad', direccion='$direccion', postal='$postal' WHERE userid=$customerid";


            $updated = mysqli_query($conexion, $up_sql);


            if ($updated) {
                if (isset($_SESSION['cart'])) {
                    $total = 0;
                    foreach ($cart as $key => $value) {
                        // echo $key ." : ". $value['quantity'] . "<br>";

                        $sql_cart = "SELECT * FROM platos where id = $key";
                        $result_cart = mysqli_query($conexion, $sql_cart);
                        $row_cart = mysqli_fetch_assoc($result_cart);
                        $total = $total +  ($row_cart['precio'] * $value['quantity']);
                    }
                }

                $insertOrder = "INSERT INTO orders (userid, totalprice, orderstatus, paymentmode )
	        VALUES ('$customerid', '$total', 'Pedido realizado', '$payment')";

                if (mysqli_query($conexion, $insertOrder)) {

                    $orderid = mysqli_insert_id($conexion);

                    foreach ($cart as $key => $value) {
                        $sql_cart = "SELECT * FROM platos where id = $key";
                        $result_cart = mysqli_query($conexion, $sql_cart);
                        $row_cart = mysqli_fetch_assoc($result_cart);

                        $price_product = $row_cart["precio"];
                        $q  = $value["quantity"];

                        $insertordersItems = "INSERT INTO ordersItems (orderid, productid, quantity, productprice) 
        VALUES ('$orderid', '$key', '$q', '$price_product')";

                        if (mysqli_query($conexion, $insertordersItems)) {
                            //    echo 'inserted on both table orders and ordersItems';
                            unset($_SESSION['cart']);
                            // header("location:cuenta.php");
                            echo '<script>window.location.href = "cuenta.php";</script>';
                        }
                    }
                }
            }
        } else {
            $ins_sql = "INSERT INTO users_data (userid, nombre, apellido, telefono, ciudad, direccion, postal)
        VALUES ('$customerid', '$nombre', '$apellido', '$telefono', '$ciudad', '$direccion', '$postal')";

            $inserted = mysqli_query($conexion, $ins_sql);

            if ($inserted) {

                // echo 'order table and order items - inserted';

                if (isset($_SESSION['cart'])) {
                    $total = 0;
                    foreach ($cart as $key => $value) {
                        // echo $key ." : ". $value['quantity'] . "<br>";

                        $sql_cart = "SELECT * FROM platos where id = $key";
                        $result_cart = mysqli_query($conexion, $sql_cart);
                        $row_cart = mysqli_fetch_assoc($result_cart);
                        $total = $total +  ($row_cart['precio'] * $value['quantity']);
                    }
                }


                // echo 'order table and order items - updated';

                $insertOrder = "INSERT INTO orders (userid, totalprice, orderstatus, paymentmode )
		VALUES ('$cid', '$total', 'Pedido realizado', '$payment')";

                if (mysqli_query($conexion, $insertOrder)) {

                    $orderid = mysqli_insert_id($conexion);
                    foreach ($cart as $key => $value) {
                        $sql_cart = "SELECT * FROM platos where id = $key";
                        $result_cart = mysqli_query($conexion, $sql_cart);
                        $row_cart = mysqli_fetch_assoc($result_cart);
                        $price_product = $row_cart["price"];
                        $q  = $value["quantity"];
                        $insertordersItems = "INSERT INTO ordersItems (orderid, productid, quantity, productprice) 
				VALUES ('$orderid', '$key', '$q', '$price_product')";

                        if (mysqli_query($conexion, $insertordersItems)) {
                            //    echo 'inserted on both table orders and ordersItems';
                            unset($_SESSION['cart']);
                            // header("location:cuenta.php");
                            echo '<script>window.location.href = "cuenta.php";</script>';
                        }
                    }
                }
            }
        }
    } else {
        echo "acepta p";
    }
}
$customerid = $_SESSION['customerid'];

$sql = "SELECT * FROM users_data where userid = $customerid";
$result = mysqli_query($conexion, $sql);
$row = mysqli_fetch_assoc($result);

// echo "<pre>";
// print_r($_POST);
// echo "<pre>";

// echo $_SESSION['customer']."<br>";
// echo $_SESSION['customerid']."<br>";




if (isset($_SESSION['cart'])) {
    $total = 0;
    foreach ($cart as $key => $value) {
        // echo $key ." : ". $value['quantity'] . "<br>";

        $sql_cart = "SELECT * FROM platos where id = $key";
        $result_cart = mysqli_query($conexion, $sql_cart);
        $row_cart = mysqli_fetch_assoc($result_cart);
        $total = $total +  ($row_cart['precio'] * $value['quantity']);
    }
}







?>

<h2 class="cart-title">Pago</h2>

<form method="post">

    <div class="pago-container">
        <div class="terminos-condiciones">
            <form>
                <div class="facturacion">
                    <h3>Dirección de Facturación</h3>
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="<?php if (isset($row['nombre'])) {
                                                                            echo $row['nombre'];
                                                                        } ?>" required>

                    <label for="apellido">Apelido:</label>
                    <input type="text" id="apellido" name="apellido" value="<?php if (isset($row['apellido'])) {
                                                                                echo $row['apellido'];
                                                                            } ?>" required>

                    <label for="telefono">Teléfono:</label>
                    <input type="text" id="telefono" name="telefono" value="<?php if (isset($row['telefono'])) {
                                                                                echo $row['telefono'];
                                                                            } ?>" required>

                    <label for="ciudad">Ciudad:</label>
                    <input type="text" id="ciudad" name="ciudad" value="<?php if (isset($row['ciudad'])) {
                                                                            echo $row['ciudad'];
                                                                        } ?>" required>

                    <label for="direccion">Dirección:</label>
                    <input type="text" id="direccion" name="direccion" value="<?php if (isset($row['direccion'])) {
                                                                                    echo $row['direccion'];
                                                                                } ?>" required>

                    <label for="postal">Código postal:</label>
                    <input type="text" id="postal" name="postal" value="<?php if (isset($row['postal'])) {
                                                                            echo $row['postal'];
                                                                        } ?>" required>
                </div>

                <div class="metodo">
                    <h3>Método de Pago</h3>
                    <select name="payment" required>
                        <option value="">Seleccionar</option>
                        <option value="Tarjeta de crédito">Tarjeta de crédito</option>
                        <option value="Transferencia bancaria">Transferencia bancaria</option>
                        <option value="Efectivo">Efectivo</option>
                    </select>
                </div>

                <div class="terminos">

                    <input name="agree" value='true' type="checkbox" id="terminos_condiciones">
                    Acepto los términos y condiciones

                </div>
                <?php
                // Obtener la hora actual del servidor
                
                $hora_actual = date('H:i');
            

                
                if ($hora_actual >= '08:00' && $hora_actual <= '19:00') {
                    echo '<input type="submit" name="submit" value="Pagar">';
                } else {
                    echo '<div id="errorDiv">
              <span id="errorMessage">Fuera de horario de compra</span>
          </div>';
                }
                ?>


            </form>

        </div>
    </div>

</form>



<?php include("templates/footer.php"); ?>