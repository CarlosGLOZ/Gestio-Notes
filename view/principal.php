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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        <p class="bienvenida"> | ㅤBienvenido <?php echo "<b>".$_SESSION[GESTOR['nombre']]."</b>" ?></p>
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
    </div>
    <!----------------------------------------------------------FIN BOTONES---------------------------------------------------------->
    
    <!----------------------------------------------------------1 VENTANA MODAL---------------------------------------------------------->
    <input type="checkbox" id="btn-modal">
    <div class="container-modal">
            <div class="formulario">
                <form action="crear_controller.php" method="Post">

                    <h2><i class="fa-solid fa-user-tag"></i> Nombre completo</h2> 
                    <!--NOMBRE COMPLETO-->
                    <small id="error_nombre" class="alerts"><b><i class="fa-solid fa-circle-exclamation"></i> Error en el campo nombre </b></small>   
                    <input type="text" name="<?php echo ALUMNO['nombre'];?>" id="nombre"  placeholder="Nombre" required> 

                    <small id="error_primer_apellido" class="alerts"><b><i class="fa-solid fa-circle-exclamation"></i> Error en el campo primer apellido </b></small> 
                    <input type="text" name="<?php echo ALUMNO['primer_apellido'];?>" id="primer_apellido" placeholder="Primer apellido" required>  
  
                    <small id="error_segundo_apellido" class="alerts"><b><i class="fa-solid fa-circle-exclamation"></i> Error en el campo segundo apellido </b></small>   
                    <input type="text" name="<?php echo ALUMNO['segundo_apellido'];?>" id="segundo_apellido"  placeholder="Segundo apellido" required>
                  

                    <h2><i class="fa-solid fa-id-card"></i> Dni</h2>
                    <!--DNI-->
                    <small id="error_dni" class="alerts"><b><i class="fa-solid fa-circle-exclamation"></i> Error en el campo DNI </b></small>   
                    <input type="text" name="<?php echo ALUMNO['dni'];?>" id="dni_alu" placeholder="dni" required>
                 


                    <h2><i class="fa-solid fa-square-envelope"></i> e-mail</h2>
                    <!--EMAIL-->
                    <small id="error_email" class="alerts"><b><i class="fa-solid fa-circle-exclamation"></i> Error en el campo Email </b></small>   
                    <input type="email" name="<?php echo ALUMNO['email'];?>" id="e_mail" placeholder="e-mail" required>
                 

                    <!--BOTON ENVIAR-->
                    <button type="submit" name="registro" class="btn btn-success btn-lg btn-outline-info" onclick="validarcrearalumno()" value="Enviar correo" id="btn">
                        <div class="cerrado"> 
                            <i class="fa-solid fa-user-plus"></i>
                        </div> 

                        <div class="abierto">
                            <i class="fa-solid fa-user-check"></i>
                        </div>  
                    </button>

                    <?php
                    // ERRORES FORMULARIO DE CREAR:
                    if(isset($_GET['error'])){
                        if($_GET['error']=='camposVacios'){
                            echo "Te has olvidado de introducir algún campo!";
                        }
                    }
                    if(isset($_GET['error'])){
                        if($_GET['error']=='checkUser'){
                            echo "El usuario ya existe en la base de datos!";
                        }
                    }
                    if(isset($_GET['error'])){
                        if($_GET['error']=='errorEmail'){
                            echo "El formato del correo no es válido, utiliza otro correo.";
                        }
                    }
                    ?>
                </form>
            </div>
            
            <label for="btn-modal" class="close" id="cerrar"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg></label>
    </div>
    <!-------------------------------------------------------FIN VENTANA MODAL---------------------------------------------------------->


    <!----------------------------------------------------------2 VENTANA MODAL---------------------------------------------------------->
    <input type="checkbox" id="btn2-modal">
    <div class="container2-modal">
        <div class="formulario" id="form">
            <form method="Post" action="../proc/enviar_correo.php">
            
                <h2><i class="fa-solid fa-envelopes-bulk"></i> Enviar e-mail</h2>

                 <!--ZONA SELECTOR-->               
              
                 <select id="grupoEmail" name="grupo" onchange="selectedGroup();">
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
                <small id="error_correo"  class="alerts"><b><i class="fa-solid fa-circle-exclamation"></i> Error en el campo email </b></small>   
                <input  placeholder="e-mail" type="email" id="email" name="correo" required>

                <!--ZONA ASUNTO-->
                <small id="error_asunto"  class="alerts"><b><i class="fa-solid fa-circle-exclamation"></i> Error en el campo asunto </b></small>   
                <input placeholder="Asunto" type="text" id="asunto" name="asunto" required>

                <!--ZONA MENSAJE-->     
                <small id="error_mensaje"  class="alerts"><b><i class="fa-solid fa-circle-exclamation"></i> Error en el campo mensaje </b></small>              
                <textarea  placeholder="Escribe tu mensaje" name="cuerpo" id="mensaje" cols="30" rows="10" require></textarea>

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
            
            <label for="btn2-modal" class="close2" id="cerrar2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg></label>
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


    <!--------------------------------------------INICIO TABLA DE DATOS Y PAGINACIÓN---------------------------------------------------->
    <div class="pag">
        <form action="index_controller.php" method="get">
            <label for="por_pagina">Alumnos por página:</label>
            <input class="num_page" id="por_pagina" type="number" name="por_pagina"> 
            <!-- <input type="submit"  class="num_page" value="Cambiar"> -->
        </form> 
    </div>


    <?php
    if (isset($_GET['por_pagina']) && $_GET['por_pagina']>0 ) {
        $por_pagina=$_GET['por_pagina'];
    } else {
        $por_pagina=5;
    }


    if (isset($_GET['pagina'])) {
        $pagina=$_GET['pagina']; 
    
    } else {
        $pagina=1;
    }

    $empieza=($pagina-1)*$por_pagina;
        
    $empieza=($pagina-1) * $por_pagina;

    $sentencia = 
            "SELECT * FROM ".ALUMNO['tabla']." 
            WHERE ".ALUMNO['nombre']." LIKE '%".$filtro_nombre."%' 
            AND (".ALUMNO['primer_apellido']." LIKE '%".$filtro_apellidos."%'
            OR ".ALUMNO['segundo_apellido']." LIKE '%".$filtro_apellidos."%')
            AND ".ALUMNO['email']." LIKE '%".$filtro_email."%'
            AND ".ALUMNO['dni']." LIKE '%".$filtro_dni."%'
            LIMIT $empieza,$por_pagina;";


            $listado_alumnos = mysqli_query($conexion, $sentencia);


        $query= "SELECT * FROM ".ALUMNO['tabla']." 
        WHERE ".ALUMNO['nombre']." LIKE '%".$filtro_nombre."%' 
        AND (".ALUMNO['primer_apellido']." LIKE '%".$filtro_apellidos."%'
        OR ".ALUMNO['segundo_apellido']." LIKE '%".$filtro_apellidos."%')
        AND ".ALUMNO['email']." LIKE '%".$filtro_email."%'
        AND ".ALUMNO['dni']." LIKE '%".$filtro_dni."%'
        ;";
        $resultado=mysqli_query($conexion,$query);


        $total_registros=mysqli_num_rows($resultado);

        if ($por_pagina> $total_registros) {

            echo "<p style='text-align: center;'>Mostrando $total_registros alumnos por página</p>";
        } else {
            echo "<p style='text-align: center;font-size: 12px;'>Mostrando $por_pagina alumnos por página</p>";
        }
        ?>

    <div class="crud">
        
        <?php
        // MOSTRAR DATOS EN FORMA DE TABLA:
        echo '<table class="tablacrud table table-striped ">';
            echo '<tr class="bloqueado">';
                echo '<th id="primero">ID</th>';
                echo '<th id="titulo">NOMBRE</th>';
                echo '<th id="titulo">APELLIDOS</th>';
                echo '<th id="titulo">EMAIL</th>';
                echo '<th id="titulo">DNI</th>';
                echo '<th id="titulo">MODIFICAR</th>';
                echo '<th id="ultimo">ELIMINAR</th>';
            echo '</tr>';
            foreach ($listado_alumnos as $alumno) {
                echo '<tr>';
                    echo "<td>{$alumno['id_alumno']}</td>";
                    echo "<td>{$alumno['nombre_alumno']}</td>";
                    echo "<td>{$alumno['primer_apellido_alumno']} {$alumno['segundo_apellido_alumno']}</td>";
                    echo "<td>{$alumno['email_alumno']}</td>";
                    echo "<td>{$alumno['dni_alumno']}</td>";
                    echo "<td><a href='../controller/form_mod_controller.php?id_alumno={$alumno['id_alumno']}'><button type='button' class='btncrudmodificar btn btn-primary'>Modificar</button></a></td>";
                    echo "<td><a href='../controller/eliminar_controller.php?id_alumno={$alumno['id_alumno']}'><button type='button' class='btncrudenviar btn btn-danger'>Eliminar</button></a></td>";           
                echo "</tr>";
            }
        echo '</table>';

        $total_paginas=ceil($total_registros/$por_pagina);

        $pagina_menos=$pagina-1;

        $pagina_mas=$pagina+1;

        ?>

    </div>
    <!--------------------------------------------INICIO VISUALIZACIÓN DE PAGINACIÓN---------------------------------------------------->
    <div class="paginacion">
        <?php
        echo "<center>";

        if ($pagina==1) {
            // echo"<a class='casilla' href='index_controller.php?pagina=1'>"  .'Anterior'. "</a>";
        } else {
            if ($por_pagina==5) {
                echo"<a class='casilla' href='index_controller.php?pagina=1'>"  .'<i class="fa-solid fa-book"></i>'. "</a> ";
                echo"<a class='casilla' href='index_controller.php?pagina=$pagina_menos'>"  .'<i class="fa-solid fa-arrow-left"></i>'. "</a> ";
            } else {
                echo"<a class='casilla' href='index_controller.php?pagina=1&&por_pagina=$por_pagina'>"  .'<i class="fa-solid fa-book"></i>'. "</a> ";
                echo"<a class='casilla' href='index_controller.php?pagina=$pagina_menos&&por_pagina=$por_pagina'>"  .'<i class="fa-solid fa-arrow-left"></i>'. "</a> ";
            }

        }

        for($i=1;  $i<=$total_paginas;   $i++)

        {

        if ($i==$pagina) {
            if ($por_pagina==5) {
                echo"<a style=' background: #7D7199;' class='casilla' href='index_controller.php?pagina=".$i."'> ".$i." </a> ";
            } else {
                echo"<a style=' background: #7D7199;' class='casilla' href='index_controller.php?pagina=".$i."&&por_pagina=$por_pagina'> ".$i." </a> ";
            }

        }
        else if ( $i==$pagina+1 || $i==$pagina+2 || $i==$pagina-1 || $i==$pagina-2) {
            if ($por_pagina==5) {
                echo"<a class='casilla' href='index_controller.php?pagina=".$i."'> ".$i." </a> ";
            } else {
                echo"<a class='casilla' href='index_controller.php?pagina=".$i."&&por_pagina=$por_pagina'> ".$i." </a> ";
            }
            
        }

        }

        if ($pagina==$total_paginas) {

        } else {

            if ($por_pagina==5) {
                echo"<a class='casilla' href='index_controller.php?pagina=$pagina_mas'>"  .'<i class="fa-solid fa-arrow-right"></i>'. "</a> ";
                echo"<a class='casilla' href='index_controller.php?pagina=$total_paginas'>"  .'<i class="fa-solid fa-book"></i>'. "</a> ";
            } else {
                echo"<a class='casilla' href='index_controller.php?pagina=$pagina_mas&&por_pagina=$por_pagina'>"  .'<i class="fa-solid fa-arrow-right"></i>'. "</a> ";
                echo"<a class='casilla' href='index_controller.php?pagina=$total_paginas&&por_pagina=$por_pagina'>"  .'<i class="fa-solid fa-book"></i>'. "</a> ";
            }
        }
        echo "</center>"; ?>
    </div>
    
    <!----------------------------------------------------------FIN TABLA DE DATOS ---------------------------------------------------------->

</body>

</html>


    <!----------------------------------------------------------VERIFICACIÓN MAIL---------------------------------------------------------->

<?php
    if (isset($_GET['correo_eniviado'])) {
        ?>
        <script>
    Swal.fire({
        background:'#443E53',
        color:'white',
    icon: 'success',
    iconColor:'#719972',
    title: 'Correo enviado correctamente!'

    })

        </script>


        <?php
    }