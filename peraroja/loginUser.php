<?php include("templates/header.php"); ?>
<h2 class="cart-title">Cuenta</h2>
<div class="login-container">
  <div class="login">
    <h2>Iniciar Sesión</h2>
    <form action="loginProcess.php" method="post">
      <?php
      if (isset($_REQUEST['message'])) {
        if ($_GET['message'] == '1') {
      ?>
          <div id="errorDiv">
            <span id="errorMessage">Credenciales incorrectas</span>
          </div>
      <?php
        }
      }
      ?>

      <input type="email" placeholder="Correo electrónico" required name="email">
      <input type="password" placeholder="Contraseña" required name="password">
      <button type="submit" name="submit">Iniciar Sesión</button>

      <p>¿No tienes cuenta? <a href="registerUser.php">Registrate</a></p>
    </form>
  </div>
      
  
</div>

<?php include("templates/footer.php"); ?>