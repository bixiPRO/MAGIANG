<?php
   session_start();
   require('connection.php');
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Login - Magiang</title>
  <link rel="stylesheet" href="css/login-style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <div class="wrapper">
    <!-- Radio buttons para el control del slide -->
    <input type="radio" name="slide" id="login" checked hidden>
    <input type="radio" name="slide" id="signup" hidden>

    <!-- Títulos -->
    <div class="title-text">
      <div class="title login">Iniciar Sesión</div>
      <div class="title signup">Registrarse</div>
    </div>

    <!-- Formulario contenedor -->
    <div class="form-container">
      <div class="slide-controls">
        <label for="login" class="slide login">Accede</label>
        <label for="signup" class="slide signup">Regístrate</label>
        <div class="slider-tab"></div>
      </div>

      <div class="form-inner">
        <!-- Formulario de Login -->
        <form action="do_login.php" method="POST" class="login">
          <div class="field">
            <input type="text" placeholder="Correo Electrónico" name="gmail" required>
          </div>
          <div class="field">
            <input type="password" placeholder="Contraseña" name="pwd" required>
          </div>
          <div class="field btn">
            <div class="btn-layer"></div>
            <input type="submit" name="submit" value="Iniciar Sesión">
          </div>
          <div class="signup-link">
            No eres miembro? <a href="#signup">Regístrate ahora</a><br>
            <a href="home.php">Volver al inicio</a>
          </div>
        </form>

        <!-- Formulario de Registro -->
        <form action="do_register.php" method="POST" class="signup">
          <div class="field">
            <input type="text" placeholder="Correo Electrónico" name="gmail" required>
          </div>
          <div class="field">
            <input type="password" placeholder="Contraseña" name="pwd1" required>
          </div>
          <div class="field">
            <input type="password" placeholder="Confirma Contraseña" name="pwd2" required>
          </div>

          <?php if(isset($_POST['pwd1']) && isset($_POST['pwd2'])): ?>
            <?php if($_POST['pwd1'] == $_POST['pwd2']): ?>
              <p>La contraseña es la misma</p>
            <?php else: ?>
              <p>La contraseña no coincide</p>
            <?php endif; ?>
          <?php endif; ?>

          <div class="field btn">
            <div class="btn-layer"></div>
            <input type="submit" name="submit" value="Empieza">
          </div>
          <div class="signup-link">
            <a href="home.php">Volver al inicio</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>