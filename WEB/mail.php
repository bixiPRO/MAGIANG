<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'soporte.magiang@gmail.com';                     //SMTP username
    $mail->Password   = 'kkyy ojhu xlaj alup';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('soporte.magiang@gmail.com', 'MAGIANG');
    $mail->addAddress('mbailo@institutmvm.cat', 'Sergi cerdo');     //Add a recipient


    //Content
  #  $mail->addEmbeddedImage('ruta/a/archivo_de_imajen.jpg', 'image_cid');
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'PROVA';
    $mail->Body    = '<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mail Message | Magiang </title>
        <style>
    body {
      background-color: #f4f4f4;
      font-family: Arial, sans-serif;
    }
    h1 {
      color: #333;
      text-align: center;
    }
    p {
      color: #555;
      font-size: 16px;
    }
  </style>
    </head>
    <body>
        <main>
            <h1 class="title">Magiang Shopping</h1>
            <h1>Gracias!</h1>
            <h2>Su compra se ha realizado correctamente</h2>
            <h3>Su pedido es el siguiente:</h3>
            <hr>
            <div class="order-details">
                <img src="cid:image_cid">
                <p><a class="bold">Nombre:</a> {{name}}</p>
                <p><a class="bold">Dirección:</a> {{address}}</p>
                <p><a class="bold">Teléfono:</a> {{phone}}</p>
                <p><a class="bold">Email:</a>{{email}}</p>
                <p><a class="bold">Fecha de compra:</a> {{date}}</p>
                <p><a class="bold">Total:</a> ${{total}}</p>
                <p class="bold">Productos:</p>
                <ul>
                    {{#each products}}
                        <li>{{this.name}} - ${{this.price}}</li>
                    {{/each}}
                </ul>
                <hr>
                <p>Gracias por confiar en nosotros, esperemos que vuelva a solicitar nuestros servicios</p>
                <p>¿Hay algo mal?, no dude en contactarnos <a  class="mail" href="contacto.html">soporte.magiang@gmail.com</a></p>
            </div>
        </main>
    </body>

</html>';

    $mail->send();
    echo 'Mensage enviado';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
