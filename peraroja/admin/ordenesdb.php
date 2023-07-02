<?php include('templates/header.php'); ?>

<?php
include("config/db.php");

$sqlOrdenes1 = $conection->prepare("SELECT * FROM orders ORDER BY id DESC");
$sqlOrdenes1->execute();
$orden1 = $sqlOrdenes1->fetchAll(PDO::FETCH_ASSOC);









?>




<h2 class="title">Administrar ordenes</h2>

<div class="container">
    <div class="platos-container">
        <div class="data-table-order">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Precio total</th>
                        <th>Estado</th>
                        <th>Método de pago</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orden1 as $adicional) { ?>
                        <tr>
                            <td>NO<?php echo $adicional['id']; ?></td>
                            <td><?php
                                $userid = $adicional['userid'];
                                $sqlCliente = "SELECT nombre, apellido FROM users_data WHERE userid = $userid";
                                $resultado = mysqli_query($conexion, $sqlCliente);
                                $fila = mysqli_fetch_assoc($resultado);
                                ?>
                                <?php echo $fila['nombre']; ?> <?php echo $fila['apellido']; ?>
                            </td>
                            <td>$<?php echo $adicional['totalprice']; ?></td>
                            <td><?php echo $adicional['orderstatus']; ?></td>
                            <td><?php echo $adicional['paymentmode']; ?></td>
                            <td><?php echo date('M j g:i A', strtotime($adicional["timestamp"]));  ?></td>
                            <td>
                                <form method="post">
                                    <a class="btn-elegir" href="ordendb.php?id=<?php echo $adicional["id"]?>">Ver orden</a>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>

</div>