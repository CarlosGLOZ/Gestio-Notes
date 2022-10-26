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
        <a class="enlace" href="./principal.php">
            <img src="../static/img/logo/svg/2.2.svg" alt="Logo" class="logo-peq">
        </a>
        <a class="enlace" href="./principal.php">
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
        <label for=""><i class="fa-solid fa-magnifying-glass"></i></label>
    </div>
    <!----------------------------------------------------------FIN BOTONES---------------------------------------------------------->

    <!----------------------------------------------------------BOTONES FILTROS---------------------------------------------------------->
    <div class="boton-modal">
        <form action="" method="get">
            <input type="text" name="filtro-nombre" placeholder="nombre">
            <input type="text" name="filtro-apellidos" placeholder="apellidos">
            <input type="text" name="filtro-email" placeholder="email">
            <input type="text" name="filtro-dni" placeholder="dni">
            <input type="submit" value="buscar">
        </form>
    </div>
    <!----------------------------------------------------------FIN FILTROS---------------------------------------------------------->

    <!----------------------------------------------------------FIN TABLA DE DATOS ---------------------------------------------------------->
    <?php
    // MOSTRAR DATOS EN FORMA DE TABLA:
    echo "<a href='../view/crear.php'><button style='margin-bottom: 10px;' type='button' class='btn btn-success'>Crear</button></a>";
    echo '<table style="border: solid 2px #c4c4c4;" class="table table-striped">';
        echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>NOMBRE</th>';
            echo '<th>APELLIDOS</th>';
            echo '<th>EMAIL</th>';
            echo '<th>DNI</th>';
            echo '<th>MODIFICAR</th>';
            echo '<th>ELIMINAR</th>';
        echo '</tr>';
        foreach ($listado_alumnos as $alumno) {
            echo '<tr>';
                echo "<td>{$alumno['id_alumno']}</td>";
                echo "<td>{$alumno['nombre_alumno']}</td>";
                echo "<td>{$alumno['primer_apellido_alumno']} {$alumno['segundo_apellido_alumno']}</td>";
                echo "<td>{$alumno['email_alumno']}</td>";
                echo "<td>{$alumno['dni_alumno']}</td>";
                echo "<td><a href='../controller/form_mod_controller.php?id_alumno={$alumno['id_alumno']}'><button type='button' class='btn btn-primary'>Modificar</button></a></td>";
                echo "<td><a href='../controller/eliminar_controller.php?id_alumno={$alumno['id_alumno']}'><button type='button' class='btn btn-danger'>Eliminar</button></a></td>";           
            echo "</tr>";
        }
    echo '</table>';
    ?>
    <!----------------------------------------------------------FIN TABLA DE DATOS ---------------------------------------------------------->
    
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
        <div class="formulario">
            <form method="Post" action="../proc/enviar_correo.php">
            
                <h2><i class="fa-solid fa-envelopes-bulk"></i> Enviar e-mail</h2>

                 <!--ZONA SELECTOR-->               
                <select name="grupo">
                    <option value="none">Seleccionar Clase</option>
                    <?php
                        require_once '../config/conexion.php';
                        require_once '../proc/func.php';

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
                <button type="submit" class="btn btn-success btn-lg btn-outline-info" value="Enviar correo" onclick="return validarCorreo()"  id="btn2"> Enviar e-mail
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
    </div>
    <!-------------------------------------------------------FIN VENTANA MODAL---------------------------------------------------------->
</body>

</html>