<?php include('templates/header.php');
include("config/db.php");

$sentenceSQL = $conection->prepare("SELECT * FROM users_data");
$sentenceSQL->execute();
$clientesDataList = $sentenceSQL->fetchAll(PDO::FETCH_ASSOC);



?>

<h2 class="title">Administrar clientes</h2>
<div class="container">
  <div class="platos-container">
    <div class="data-table-order">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Distrito</th>
            <th>Dirección</th>
            <th>Código Postal</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($clientesDataList as $cliente) { ?>
            <tr>
              <td>CL<?php echo $cliente['userid']; ?></td>
              <td><?php echo $cliente['nombre']; ?></td>
              <td><?php echo $cliente['apellido']; ?></td>
              <td><?php
                  $userid = $cliente['userid'];
                  $sqlCliente = "SELECT email FROM users WHERE id = $userid";
                  $resultado = mysqli_query($conexion, $sqlCliente);
                  $fila = mysqli_fetch_assoc($resultado);
                  echo $fila['email']; ?>
              </td>
              <td><?php echo $cliente['telefono']; ?></td>
              <td><?php echo $cliente['ciudad']; ?></td>
              <td><?php echo $cliente['direccion']; ?></td>
              <td><?php echo $cliente['postal']; ?></td>
            </tr>
          <?php } ?>

        </tbody>
      </table>
    </div>






  </div>