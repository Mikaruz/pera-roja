<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pera roja</title>
  <link rel="icon" href="images/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="css/adminstyles.css" />
  <script src="https://kit.fontawesome.com/eb496ab1a0.js" crossorigin="anonymous"></script>
  <script src="buscador.js"></script>
</head>

<body>
  <header>
    <div class="principal-header">
      <div class="pera-roja-logo">
        <img src="images/mainlogo.png" alt="logo">
        <a href="index.php">
          <h2>Administración</h2>
        </a>
      </div>
      <nav>
      <?php $url = "http://" . $_SERVER['HTTP_HOST'] . "/pera-roja/peraroja" ?>
        <ul class="nav-links">
          <li>
          <a href="<?php echo $url; ?>/admin/inicio.php">Inicio</a>
          </li>
          <li>
          <a href="<?php echo $url; ?>/admin/platosdb.php">Platos</a>
          </li>
          <li>
          <a href="<?php echo $url; ?>/admin/AdicionalesDB.php">Adicionales</a>
          </li>
          <li>
            <a href="<?php echo $url; ?>/admin/ordenesdb.php">Ordenes</a>
          </li>
          <li>
            <a href="<?php echo $url; ?>/admin/clientes.php">Clientes</a>
          </li>
          <li>
            <a href="<?php echo $url; ?>">Sitio web</a>
          </li>

        </ul>
      </nav>
    </div>
  </header>