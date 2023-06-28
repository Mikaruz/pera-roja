<?php include("templates/header.php"); ?>

<?php
include("admin/config/db.php");
$categoriaPlato = 1;
$sentenceSQL = $conection->prepare("SELECT * FROM platos WHERE idcategoria <> $categoriaPlato;");
$sentenceSQL->execute();
$adicionalList = $sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<h2 class="platos-title">Disfruta de nuestros adicionales</h2>

<div class="container">
   <div class="products-container">
      <?php foreach ($adicionalList as $adicional) { ?>
         <div class="product" data-name="<?php echo $adicional['id'] ?>">
            <img src="images/platosdb/<?php echo $adicional['imagen'] ?>" alt="" width="300">
            <h3><?php echo $adicional['nombre'] ?></h3>
            <div class="price">$<?php echo $adicional['precio'] ?></div>
         </div>


      <?php } ?>
   </div>
</div>

<div class="products-preview">

   <?php foreach ($adicionalList as $adicional) { ?>
      <form id="formulario" name="formulario" method="post" action="cart.php"></form>
      <div class="preview" data-target="<?php echo $adicional['id'] ?>">

         <i class="fas fa-times"></i>
         <img src="images/platosdb/<?php echo $adicional['imagen'] ?>" alt="" width="350">
         <h3><?php echo $adicional['nombre'] ?></h3>
         <div class="stars">
            <p class="calorias"><?php echo $adicional['calorias'] ?> Calorías</p>
            <p>Proteinas: <?php echo $adicional['proteinas'] ?></p>
            <p>Carbohidratos: <?php echo $adicional['carbohidratos'] ?></p>
            <p>Grasas: <?php echo $adicional['grasas'] ?></p>
         </div>
         <p><?php echo $adicional['descripcion'] ?></p>
         <div class="price">$<?php echo $adicional['precio'] ?></div>
         <div class="buttons">
            
            <a href="Adicional.php?id=<?php echo $adicional['id'] ?>" class="submit">Ver más</a>
            <a href="addToCart.php?id=<?php echo $adicional["id"] ?>" class="buy">Añadir al carrito</a>
         </div>
      </div>
   <?php } ?>



</div>

<?php include("templates/footer.php"); ?>