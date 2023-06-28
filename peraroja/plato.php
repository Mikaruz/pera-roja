<?php include("templates/header.php"); ?>
<?php
include("admin/config/db.php");

$sentenceSQL = $conection->prepare("SELECT * FROM platos");
$sentenceSQL->execute();
$platoList = $sentenceSQL->fetchAll(PDO::FETCH_ASSOC);

$customerid = '';
if (isset($_SESSION['customerid'])) {
  $customerid = $_SESSION['customerid'];
}
?>


<?php
if (isset($_GET['id']) && !empty($_GET['id'])) {
  $idPlato = $_GET['id'];
  $sql = "SELECT id, nombre, imagen, proteinas, carbohidratos, grasas, calorias, precio, descripcion FROM platos WHERE id = $idPlato";
  $resultado = mysqli_query($conexion, $sql);

  if ($resultado && mysqli_num_rows($resultado) > 0) {
    $row = mysqli_fetch_assoc($resultado);
  } else {
    echo "El plato no existe";
  }
} else {
  header("Location: lista_platos.php");
  exit();
} ?>








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
          <input type="hidden" name='id' value="<?php echo  $idPlato ?>">
          <input type="number" name="quantity" min="1" value="1">
        </div>
        <button type='submit' class="add-to-cart">Añadir al carrito</button>

        <?php




        if (isset($_SESSION['customerid'])) {
          $sqlFav = "SELECT COUNT(*) AS count FROM favoritos WHERE productid = '$idPlato' and userid ='$customerid'";

          $resultFav = mysqli_query($conexion, $sqlFav);
          $rowFav = mysqli_fetch_assoc($resultFav);?>

          <?php
          if ($rowFav['count'] > 0) {
          } else { ?>
            <a href="favoritosProcess.php?id=<?php echo $idPlato ?>" class="add-to-cart">Añadir a favoritos</a>
          <?php } ?>
  

        <?php } ?>


        



      </form>




    </div>
  </div>



  <div class="container-reseña">
    <h2>Deja tu reseña:</h2>





    <?php


    $sql_count = "SELECT * FROM reviews where productid='$idPlato' AND userid='$customerid '";
    $result_count = mysqli_query($conexion, $sql_count);



    if (mysqli_num_rows($result_count) > 0) {



    ?>
      <div class="review-done">
        <span id="errorMessage">Reseña hecha</span>
      </div>
    <?php } else if (isset($_SESSION['customerid'])) {

      $customerid = $_SESSION['customerid'];

      $sqlUser1 = "SELECT * FROM users WHERE id = $customerid";
      $resultUser1 = mysqli_query($conexion, $sqlUser1);
      $rowUser1 = mysqli_fetch_assoc($resultUser1);

      $sqlUser2 = "SELECT * FROM users_data WHERE userid = $customerid";
      $resultUser2 = mysqli_query($conexion, $sqlUser2);
      $rowUser2 = mysqli_fetch_assoc($resultUser2);
    ?>

      <form action="reviewProcess.php" method="post">
        <div class="form-group">
          <input type="hidden" id="idplato" name="idplato" value="<?php echo $row['id'] ?>">
          <input type="hidden" id="userid" name="userid" value="<?php echo  $rowUser1['id'] ?>">
          <label for="nombre">Nombre:</label>
          <input type="text" id="nombre" name="nombre" value="<?php echo  $rowUser2['nombre'] . " " . $rowUser2['apellido'] ?>" readonly>
        </div>
        <div class="form-group">
          <label for="email">Correo:</label>
          <input type="text" id="email" name="email" value="<?php echo  $rowUser1['email'] ?>" readonly>
        </div>
        <div class="form-group">
          <label for="review">Reseña:</label>
          <textarea id="review" name="review" required></textarea>
        </div>
        <div class="form-group">
          <input type="submit" value="Enviar Reseña">
        </div>
      </form>

    <?php } else { ?>
      <div class="no-review">
        <span id="errorMessage">Debes iniciar sesión para hacer una reseña</span>
      </div>
    <?php } ?>




    <h2>Reseñas:</h2>
    <?php
    $reviewSQL = $conection->prepare("SELECT * FROM reviews WHERE productid =$idPlato");
    $reviewSQL->execute();
    $reviewrow = $reviewSQL->fetchAll(PDO::FETCH_ASSOC);

    ?>

    <?php foreach ($reviewrow as $review) {

      $userid = $review['userid'];
      $sqlCliente = "SELECT nombre, apellido FROM users_data WHERE userid = $userid";
      $resultado = mysqli_query($conexion, $sqlCliente);
      $fila = mysqli_fetch_assoc($resultado);



    ?>
      <div class="review">
        <p><strong><?php echo $fila['nombre']; ?> <?php echo $fila['apellido']; ?></strong> <?php echo date('M j g:i A', strtotime($review["timestamp"]));  ?></p>
        <p><?php echo $review['review'] ?></p>
      </div>
    <?php } ?>



  </div>





  <h3 class="sugeridos-title">Platos sugeridos</h3>
  <?php
  $categoriaPlato = 1;

  $sqlSugerencia = "SELECT * FROM platos WHERE idcategoria = $categoriaPlato AND id != $idPlato ORDER BY RAND() LIMIT 4";
  $resultSugerencia = mysqli_query($conexion, $sqlSugerencia);
  ?>










  <div class="container-sugerencia">

    <?php


    while ($rowSugerencia = mysqli_fetch_assoc($resultSugerencia)) {


    ?>
      <div class="image-box">
        <a href="plato.php?id=<?php echo $rowSugerencia['id'] ?>"><img src="images/platosdb/<?php echo $rowSugerencia['imagen'] ?>" alt="Imagen 1"></a>

        <p class="image-text"><?php echo $rowSugerencia['nombre'] ?></p>
      </div>
    <?php

    }

    ?>



  </div>




</div>




<?php include("templates/footer.php"); ?>