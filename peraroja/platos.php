<?php include("templates/header.php"); ?>

<?php
include("admin/config/db.php");
$categoriaPlato = 1;

$sentenceSQL = $conection->prepare("SELECT * FROM platos WHERE idcategoria = $categoriaPlato");
$sentenceSQL->execute();
$platoList = $sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<h2 class="platos-title">Disfruta de nuestros platos</h2>

<div class="container">
   <div class="products-container">
      <?php foreach ($platoList as $plato) { ?>
         <div class="product" data-name="<?php echo $plato['id'] ?>">
            <img src="images/platosdb/<?php echo $plato['imagen'] ?>" alt="" width="300">
            <h3><?php echo $plato['nombre'] ?></h3>
            <div class="price">$<?php echo $plato['precio'] ?></div>
         </div>
      <?php } ?>
   </div>
</div>

<div class="products-preview">

   <?php foreach ($platoList as $plato) { ?>
      <form id="formulario" name="formulario" method="post" action="cart.php"></form>
      <div class="preview" data-target="<?php echo $plato['id'] ?>">

         <i class="fas fa-times"></i>
         <img src="images/platosdb/<?php echo $plato['imagen'] ?>" alt="" width="350">
         <h3><?php echo $plato['nombre'] ?></h3>
         <div class="stars">
            <p class="calorias"><?php echo $plato['calorias'] ?> Calorías</p>
            <p>Proteinas: <?php echo $plato['proteinas'] ?></p>
            <p>Carbohidratos: <?php echo $plato['carbohidratos'] ?></p>
            <p>Grasas: <?php echo $plato['grasas'] ?></p>
         </div>
         <p><?php echo $plato['descripcion'] ?></p>
         <div class="price">$<?php echo $plato['precio'] ?></div>
         <div class="buttons">
            
            <a href="plato.php?id=<?php echo $plato['id'] ?>" class="submit">Ver más</a>
            <a href="addToCart.php?id=<?php echo  $plato["id"] ?>" class="buy">Añadir al carrito</a>
         </div>
      </div>
   <?php } ?>
</div>

<?php include("templates/footer.php"); ?>