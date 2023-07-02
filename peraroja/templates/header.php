<?php session_start(); 
include("admin/config/db.php");
date_default_timezone_set("America/Lima");
date_default_timezone_get();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pera roja</title>
  <link rel="icon" href="images/mainlogo.png" type="image/x-icon">
  <link rel="stylesheet" href="css/mainstyles.css" />
  <link rel="stylesheet" href="css/cart.css" />
  <link rel="stylesheet" href="css/plato.css" />
  <link rel="stylesheet" href="css/pago.css" />
  <link rel="stylesheet" href="css/cuenta.css" />
  <link rel="stylesheet" href="css/calculadora.css" />
  <link rel="stylesheet" href="css/loginUser.css" />
  <script src="https://kit.fontawesome.com/eb496ab1a0.js" crossorigin="anonymous"></script>
  <script src="js/platos.js" defer></script>
</head>

<body>
  <header>
    <div class="principal-header">
      <div class="pera-roja-logo">
        <img src="images/mainlogo.png" alt="logo">
        <a href="index.php">
          <h2>Pera roja</h2>
        </a>
      </div>
      <nav>
        <ul class="nav-links">
          <li>
            <a href="index.php">Inicio</a>
          </li>
          <li>
            <a href="platos.php">Platos</a>
          </li>
          <li>
            <a href="Adicionales.php">Adicionales</a>
          </li>
          <li>
            <a href="terminosycondiciones.php">Términos y Condiciones</a>
          </li>
          <li>
            <a href="login.html">Administracion</a>
          </li>
          <li>
          <?php
            $user = 'Entrar';
            $link = "loginUser.php";
            if (isset($_SESSION['customerid'])) {
              $customerid =$_SESSION['customerid'];

              $sql = "SELECT * FROM users_data where userid = $customerid";
              $result = mysqli_query($conexion, $sql);
              $row = mysqli_fetch_assoc($result);  
              $user = $row['nombre'];
              $link = "cuenta.php";
            }
            ?>

            <img src="./images/user.png" alt="user" />
            <a href=<?php echo $link; ?>><?php echo $user; ?></a>

            





          </li>
          <li>
          <img src="./images/cart.png" alt="cart" />
            <?php
            $count = '0';

            if (isset($_SESSION['cart'])) {
              $cart = $_SESSION['cart'];
              $count = count($cart);
              
            }
            ?>
            
            <a href="cart.php"><?php echo $count ?></a>
          </li>
        </ul>
      </nav>
    </div>
  </header>