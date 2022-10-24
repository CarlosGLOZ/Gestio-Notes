<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- LINK BOOTSTRAP -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- LINK CSS -->
    <link rel="stylesheet" href="./static/css/entrar.css">
    <!-- LINK FONT AWESOME -->
    <script src="https://kit.fontawesome.com/2b5286e1aa.js" crossorigin="anonymous"></script>
    <!-- LINK GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet">

 <!-- LINK JS -->
 <script type="text/javascript" src="./correo.js"></script>

    <title>Document</title>
</head>
<body>
<form method="POST" action="enviar.php">




    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <a class="enlace">
            <img src="./static/img/Logo login - pequeño.png" alt="Logo login - pequeño" class="logo-peq">
        </a>
        <a class="enlace">
            <img src="./static/img/Logo login - grande.png" alt="Logo login" class="logo">
        </a>
        <ul>
            <li><a href="../proc/cerrar_sesion.php">Volver</a></li>
        </ul>
    </nav>

<div class="mydiv">
    <div class="formulario">
<form method="Post" action="">
   
<h2>ENVIAR EMAIL <i class="fa-solid fa-envelopes-bulk"></i></h2>

<input  type="email" id="email" name="email" required>

<input placeholder="Asunto" type="text" id="asunto" name="asunto" required>

<textarea  placeholder="Escribe tu mensaje" name="mensaje" id="mensaje" cols="30" rows="10"></textarea>







<button type="submit" class="btn btn-success btn-lg btn-outline-info" value="Enviar correo" onclick="return validarCorreo()"  id="btn"> Enviar correo
  <div class="cerrado"><i class="fa-solid fa-envelope "></i></div>   <div class="abierto"><i class="fa-solid fa-envelope-open "></i></div>  </button>
  
    </div>
</form>


</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>





</body>
</html>