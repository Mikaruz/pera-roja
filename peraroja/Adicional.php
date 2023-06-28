<?php include("templates/header.php"); ?>
<?php
include("admin/config/db.php");
$sentenceSQL = $conection->prepare("SELECT * FROM platos");
$sentenceSQL->execute();
$adicionaleslist = $sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
?>
<?php
if (isset($_GET['id']) && !empty($_GET['id'])) {
  $idAdicional = $_GET['id'];

  // Realizar acciones relacionadas con el pago y los detalles del plato
  // Aquí puedes incluir tu lógica personalizada

  // Obtener los detalles del plato desde la base de datos
  // Suponiendo que tienes una conexión a la base de datos establecida

  // Consulta SQL para obtener el nombre y el precio del plato
  $sql = "SELECT id, nombre, imagen, proteinas, carbohidratos, grasas, calorias, precio, descripcion FROM platos WHERE id = $idAdicional";
  $resultado = mysqli_query($conexion, $sql);

  // Verificar si se obtuvo un resultado válido
  if ($resultado && mysqli_num_rows($resultado) > 0) {
    // Obtener los datos del plato
    $row = mysqli_fetch_assoc($resultado);
  } else {
    // Manejar el caso en que no se encuentre el plato
    echo "El Adicional no existe";
  }
} else {
  header("Location: lista_adicionales.php");
  exit();
}
?>
<h2 class="terminos-condiciones-title"><?php echo $row['nombre'] ?></h2>
<div class="terminos-condiciones">
  <div class="dish-container">
    <img src="images/platosdb/<?php echo $row['imagen'] ?>" alt="">
    <div class="dish-details">
      <h3><?php echo $row['calorias'] ?> Calorías</h3>
      <div class="description">
        <p><?php echo $row['descripcion'] ?></p>
      </div>
      <div class="nutrition">
        <ul>
          <li><span>Proteínas: </span><?php echo $row['proteinas'] ?>g</li>
          <li><span>Carbohidratos: </span><?php echo $row['carbohidratos'] ?>g</li>
          <li><span>Grasas: </span><?php echo $row['grasas'] ?>g</li>
        </ul>
      </div>
      <form action="addToCart.php">
        <div class="quantity">
          <p>Cantidad:</p>
          <input type="hidden" name='id' value="<?php echo  $idAdicional ?>">
          <input type="number" name="quantity" min="1" value="1">
        </div>
        <button type='submit' class="add-to-cart">Añadir al carrito</button>
      </form>




    </div>
  </div>


</div>




<?php include("templates/footer.php"); ?>