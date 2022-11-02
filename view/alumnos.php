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
    <link rel="stylesheet" href="../static/css/principal.css">
    <!-- LINK JS -->
    <script type="text/javascript" src="../static/js/script.js"></script>
    <!-- LINK FONT AWESOME -->
    <script src="https://kit.fontawesome.com/2b5286e1aa.js" crossorigin="anonymous"></script>
    <link rel="icon" href="../static/img/logo/svg/2.svg">
    <title>Página Principal - CAHM</title>
</head>

<body>

    <?php
        if (!isset($entrada_valida)) {
            echo "<script>window.location.href='../controller/index_controller.php'</script>";
        }
    ?>

    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <a class="enlace" href="../controller/index_controller.php">
            <img src="../static/img/logo/svg/2.2.svg" alt="Logo" class="logo-peq">
        </a>
        <a class="enlace" href="../controller/index_controller.php">
            <img src="../static/img/logo/svg/1.1.svg" alt="Logo" class="logo">
        </a>
        <p class="bienvenida"> | Bienvenido <?php echo $_SESSION[GESTOR['nombre']]; ?> <!--Aqui va variable para el nombre del user--></p>
        <ul>
            <li><a href="../proc/cerrar_sesion.php">Cerrar sesión</a></li>
        </ul>
    </nav>

    <!--<div class="mydiv">
        <h1>Bienvenido a CAHM</h1>
    </div> -->


    <!----------------------------------------------------------BOTONES MODAL---------------------------------------------------------->
    <div class="boton-modal">
        <label for="btn-modal"><i class="fa-solid fa-plus"></i></label>
        <label for="btn2-modal"><i class="fa-solid fa-envelope-open "></i></label>
        <label for="btn3-modal"><i class="fa-solid fa-magnifying-glass"></i></label> <!--buscador-->
        <button onclick="darkMode()" class="dark"><label for=""><i class="fa-sharp fa-solid fa-circle-half-stroke"></i></label></button> <!--modo oscuro-->
        <a href="../controller/index_controller.php" class="atras"><button class="dark"><label><i class="fa-solid fa-arrow-left"></i></label></button></a> <!--atras-->
    </div>
    <!----------------------------------------------------------FIN BOTONES---------------------------------------------------------->
    
    <!----------------------------------------------------------1 VENTANA MODAL---------------------------------------------------------->
    <input type="checkbox" id="btn-modal">
    <div class="container-modal">
            <div class="formulario">
                <form action="" method="Post">

                    <h2><i class="fa-solid fa-user-tag"></i> Nombre completo</h2> 
                    <!--NOMBRE COMPLETO-->
                    <input type="text" name="nom_alu"  placeholder="Nombre" required>    
                    <input type="text" name="primer_cognom_alu" placeholder="Primer apellido" required>    
                    <input type="text" name="segon_cognom_alu"  placeholder="Segundo apellido" required>


                    <h2><i class="fa-solid fa-id-card"></i> Dni</h2>
                    <!--DNI-->
                    <input type="text" name="dni_alu" placeholder="dni" required>

                    <h2><i class="fa-solid fa-square-envelope"></i> e-mail</h2>
                    <!--EMAIL-->
                    <input type="email" name="email_alu" placeholder="e-mail" required>

                    <!--BOTON ENVIAR-->
                    <button type="submit" class="btn btn-success btn-lg btn-outline-info" value="Enviar correo"  id="btn">
                        <div class="cerrado"> 
                            <i class="fa-solid fa-user-plus"></i>
                        </div> 

                        <div class="abierto">
                            <i class="fa-solid fa-user-check"></i>
                        </div>  
                    </button>

                </form>
            </div>
            
            <label for="btn-modal" class="close"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg></label>
    </div>
    <!-------------------------------------------------------FIN VENTANA MODAL---------------------------------------------------------->


    <!----------------------------------------------------------2 VENTANA MODAL---------------------------------------------------------->
    <input type="checkbox" id="btn2-modal">
    <div class="container2-modal">
        <div class="formulario" id="form">
            <form method="Post" action="../proc/enviar_correo.php">
            
                <h2><i class="fa-solid fa-envelopes-bulk"></i> Enviar e-mail</h2>

                 <!--ZONA SELECTOR-->               
                <select name="grupo">
                    <option value="none">Seleccionar Clase</option>

                    <?php
                        $modulos = getModulos($conexion);

                        foreach ($modulos as $modulo) {
                                // echo "[{$modulo['numero_modulo']}] -> [{$modulo['nombre_modulo']}]<br>";
                            echo "<option value='".$modulo['id_modulo']."'>".$modulo['numero_modulo']."-".$modulo['nombre_modulo']."</option>";
                        }
                    ?>
                </select>

                <!--ZONA E-MAIL-->
                <input  placeholder="e-mail" type="email" id="email" name="correo" required>

                <!--ZONA ASUNTO-->
                <input placeholder="Asunto" type="text" id="asunto" name="asunto" required>

                <!--ZONA MENSAJE-->                
                <textarea  placeholder="Escribe tu mensaje" name="cuerpo" id="mensaje" cols="30" rows="10"></textarea>

                <!--BOTON ENVIAR-->
                <button type="submit" class="btn btn-success btn-lg btn-outline-info" value="Enviar correo"  onclick="validarcorreoyloading()" id="btn2"> Enviar e-mail
                    <div class="cerrado">
                            <i class="fa-solid fa-envelope "></i>
                        </div>   
                        
                        <div class="abierto">
                            <i class="fa-solid fa-envelope-open "></i>
                        </div>  
                    </button>
                
            </form>
        </div>
            
            <label for="btn2-modal" class="close2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg></label>
    <!-------------------------------------------------------CARGA E-MAIL---------------------------------------------------------->
        <div class="spinner" id="loading">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>

    </div>
    <!-------------------------------------------------------FIN VENTANA MODAL---------------------------------------------------------->
    
    
    <!----------------------------------------------------------3 VENTANA MODAL---------------------------------------------------------->
    <input type="checkbox" id="btn3-modal">
    <div class="container3-modal">
        <div class="buscar">
            <form action="" method="GET">
                <input type="text" name="filtro-nombre" placeholder="Nombre">
                <input type="text" name="filtro-apellidos" placeholder="Apellidos">
                <input type="text" name="filtro-email" placeholder="E-mail">
                <input type="text" name="filtro-dni" placeholder="Dni">
                <button type="submit" name="filtro-buscar" value="Buscar" class="btnbuscar"><label for=""><i class="fa-solid fa-magnifying-glass"></i></label></button> 
            </form> 
        </div>
    </div>
    <!-------------------------------------------------------FIN VENTANA MODAL---------------------------------------------------------->
    <div class="pagnotascontenedor">
        <div class="pagnotas">
      
            <div class="column-perfil">
                <br>
                <img src="../static/img/logo/svg/2.2.svg" alt="">
                <br>
                <br>
                <h1><i class="fa-solid fa-user-graduate"></i> Eduardo Rafael, Federico </h1>
                <p><i class="fa-solid fa-address-card"></i> <b>DNI:</b> 23232323T </p>
                <P> <i class="fa-solid fa-square-envelope"></i> <b>Correo: </b> amoungus@gmail.com </P>
            </div>

            <div class="column-notas">
                    <h1><i class="fa-solid fa-clipboard-user"></i> Notas </h1>
                
                    <div class="notas">

                    <table class="table table-bordered table-hover table-striped notas bordes">
                        
                        <tr class="cabecera">
                            <td>Módulo</td>
                            <td>UF1</td>
                            <td>UF2</td>
                            <td>UF3</td>
                            <td>Media</td>
                        </tr>

                        <tr>
                            <td><i class="fa-solid fa-database"></i> Bases de Datos </td>
                            <td><input type="text" class="inputs"></td>
                            <td><input type="text" class="inputs"></td>
                            <td><input type="text" class="inputs"></td>
                            <td><input type="text" class="inputs"></td>
                        </tr>

                        <tr>
                            <td><i class="fa-brands fa-php"></i> Prog. Basica </td>
                            <td><input type="text" class="inputs"></td>
                            <td><input type="text" class="inputs"></td>
                            <td><input type="text" class="inputs"></td>
                            <td><input type="text" class="inputs"></td>
                        </tr>

                        <tr>
                            <td><i class="fa-brands fa-html5"></i> M7-123 Des. Web Cliente </td>
                            <td><input type="text" class="inputs"></td>
                            <td><input type="text" class="inputs"></td>
                            <td><input type="text" class="inputs"></td>
                            <td><input type="text" class="inputs"></td>
                        </tr>

                        <tr>
                            <td><i class="fa-brands fa-php"></i> M7-4 Des Web Servidor  </td>
                            <td><input type="text" class="inputs"></td>
                            <td><input type="text" class="inputs"></td>
                            <td><input type="text" class="inputs"></td>
                            <td><input type="text" class="inputs"></td>
                        </tr>

                        <tr>
                            <td><i class="fa-brands fa-square-js"></i> Despliegue Apps Web </td>
                            <td><input type="text" class="inputs"></td>
                            <td><input type="text" class="inputs"></td>
                            <td><input type="text" class="inputs"></td>
                            <td><input type="text" class="inputs"></td>
                        </tr>

                        <tr>
                            <td><i class="fa-solid fa-palette"></i> Diseño Inter. Web</td>
                            <td><input type="text" class="inputs"></td>
                            <td><input type="text" class="inputs"></td>
                            <td><input type="text" class="inputs"></td>
                            <td><input type="text" class="inputs"></td>
                        </tr>

                        <tr>
                            <td><i class="fa-solid fa-people-group"></i> Sintesis</td>
                            <td><input type="text" class="inputs"></td>
                            <td><input type="text" class="inputs"></td>
                            <td><input type="text" class="inputs"></td>
                            <td><input type="text" class="inputs"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

