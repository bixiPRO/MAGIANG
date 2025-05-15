<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Login - Magiang</title>
      <link rel="stylesheet" href="css/login_style_crud.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <body>
      <div class="wrapper">
         <div class="title-text"> 
            <div class="title login">
                Iniciar Sesión
            </div>
         </div>
         <div class="form-container">
            <div class="slide-controls">
               <input type="radio" name="slide" id="login" checked>
               <label for="login" class="slide login">Accede</label>
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
                     <input type="submit" name="submit" value="Iniciar Sesión">
                  </div>
               </form>
            </div>
         </div>
      </div>
      <script>
         const loginText = document.querySelector(".title-text .login");
         const loginForm = document.querySelector("form.login");
         const loginBtn = document.querySelector("label.login");
         loginBtn.onclick = (()=>{
           loginForm.style.marginLeft = "0%";
           loginText.style.marginLeft = "0%";
         });
      </script>
   </body>
</html>