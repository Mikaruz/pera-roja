<?php
include("admin/config/db.php");

$usuario = $_POST['usuario'];
$password = $_POST['password'];

$consulta = "SELECT*FROM user where usuario='$usuario' and password='$password'";
$resultado = mysqli_query($conexion, $consulta);

$filas = mysqli_num_rows($resultado);

if ($filas) {

  header("location:admin/inicio.php");
} else {
?>
  <?php
  include("login.html");

  ?>
  <h1 class="bad">ERROR DE AUTENTIFICACION</h1>
<?php
}
mysqli_free_result($resultado);
mysqli_close($conexion);
