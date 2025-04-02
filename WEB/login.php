<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Login - Magiang</title>
      <link rel="stylesheet" href="">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <body>
      <div class="wrapper">
         <div class="title-text">
            <div class="title login">
                Iniciar Sesión
            </div>
            <div class="title signup">
               Registrarse
            </div>
         </div>
         <!-- Formulario de inicio de sesión y registro -->
         <div class="form-container">
            <div class="slide-controls">
               <input type="radio" name="slide" id="login" checked>
               <input type="radio" name="slide" id="signup">
               <label for="login" class="slide login">Accede</label>
               <label for="signup" class="slide signup">Regístrate </label>
               <div class="slider-tab"></div>
            </div>
            <div class="form-inner">
               <form action="do_login.php" method="POST" class="login">
                  <div class="field">
                     <input type="text" placeholder="Correo Electrónico" name="gmail" required>
                  </div>
                  <div class="field">
                     <input type="password" placeholder="Contraseña" name="pwd" required>
                  </div>
                  <div class="field btn">
                     <div class="btn-layer"></div>
                     <input type="submit" value="Iniciar Session">
                  </div>
                  <div class="signup-link">
                     No eres miembro? <a href="">Regístrate ahora</a>
                     <a href="index.html"> Volver al inicio</a>
                  </div>
               </form>
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
                     <input type="submit" value="Empieza">
                  </div>
                  <div class="signup-link"><a href="index.html"> Volver al inicio</a></div>
               </form>
            </div>
         </div>
      </div>
      <script>
         const loginText = document.querySelector(".title-text .login");
         const loginForm = document.querySelector("form.login");
         const loginBtn = document.querySelector("label.login");
         const signupBtn = document.querySelector("label.signup");
         const signupLink = document.querySelector("form .signup-link a");
         signupBtn.onclick = (()=>{
           loginForm.style.marginLeft = "-50%";
           loginText.style.marginLeft = "-50%";
         });
         loginBtn.onclick = (()=>{
           loginForm.style.marginLeft = "0%";
           loginText.style.marginLeft = "0%";
         });
         signupLink.onclick = (()=>{
           signupBtn.click();
           return false;
         });
      </script>
   </body>
</html>