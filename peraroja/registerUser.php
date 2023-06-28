<?php include("templates/header.php"); ?>
<h2 class="cart-title">Únete a nosotros</h2>
<div class="login-container">
    <div class="register">
        <h2>Registrate</h2>
        <form action="registerProcess.php" method="post">

            <?php
            if (isset($_REQUEST['message'])) {
                if ($_GET['message'] == '2') {
            ?>
                    <div id="errorDiv">
                        <span id="errorMessage">Error al registrarse</span>
                    </div>
            <?php
                }
            }
            ?>
            <input type="text" placeholder="Nombre" name="nombre" id="nombre">
            <input type="text" placeholder="Apellido" name="apellido" id="apellido">
            <input type="text" placeholder="Teléfono" name="telefono" id="telefono">
            <input type="text" placeholder="Distrito" name="distrito" id="distrito">
            <input type="text" placeholder="Dirección" name="direccion" id="direccion">
            <input type="text" placeholder="Código postal" name="postal" id="postal">
            <input type="email" placeholder="Correo electrónico" required name="email">
            <input type="password" placeholder="Contraseña" required name="password">
            <input type="password" placeholder="Confirmar Contraseña" required name="passwordAgain">
            <button type="submit" name="submit">Registrarse</button>
        </form>
    </div>
</div>

<?php include("templates/footer.php"); ?>