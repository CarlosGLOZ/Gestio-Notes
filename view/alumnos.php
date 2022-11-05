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
            echo "<script>window.location.href='../controller/form_alu_controller.php'</script>";
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
        <!-- <label for="btn-modal"><i class="fa-solid fa-plus"></i></label> -->
        <label for="btn2-modal"><i class="fa-solid fa-envelope-open "></i></label>
        <!-- <label for="btn3-modal"><i class="fa-solid fa-magnifying-glass"></i></label> buscador -->
        <button onclick="darkMode()" class="dark"><label for=""><i class="fa-sharp fa-solid fa-circle-half-stroke"></i></label></button> <!--modo oscuro-->
        <a href="../controller/index_controller.php?" class="atras"><button class="dark"><label><i class="fa-solid fa-arrow-left"></i></label></button></a> <!--atras-->
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
                <select id="grupoEmail" name="grupo" onchange="selectedGroup();">
                    <option value="none">Seleccionar Clase</option>
                    <?php
                        $modulos = Alumno::getModulos($conexion);

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
    <div class="pagnotascontenedor ">
        <div class="pagnotas row-c">
            <div class="column-perfil">
                <br>
                <img src="../static/img/logo/svg/2.2.svg" alt="">
                <br>
                <br>
                <form action="./alumnos_controller.php" method="post">
                    <div class="icon">
                   
                        <?php echo "<input type='hidden' name='id_alumno' value='".$id_alumno."'>"?>
                        
                        <small id="error_nombre" class="alerts"><b><i class="fa-solid fa-circle-exclamation"></i> Error en el campo nombre </b></small>   
                        <p><i class="fa-solid fa-user-graduate"></i> <b>Nombre:</b><?php echo "<input type='text' class='inputsname' name='nombre_alumno' id='nombre' value='".$alumno_info['nombre_alumno']."'></input>"?>                       
                        
                        <small id="error_primer_apellido" class="alerts"><b><i class="fa-solid fa-circle-exclamation"></i> Error en el campo primer apellido </b></small> 
                        <?php echo "<input type='text'name='primer_apellido_alumno' id='primer_apellido' class='inputsname' value='".$alumno_info['primer_apellido_alumno']."'></input>"?>
                        
                        <small id="error_segundo_apellido" class="alerts"><b><i class="fa-solid fa-circle-exclamation"></i> Error en el campo segundo apellido </b></small>   
                        <?php echo "<input type='text'name='segundo_apellido_alumno' id='segundo_apellido' class='inputsname' value='".$alumno_info['segundo_apellido_alumno']."'></input>"?></p> 
                    </div>
                    <div class="icon">  
                    <small id="error_dni" class="alerts"><b><i class="fa-solid fa-circle-exclamation"></i> Error en el campo DNI </b></small>                   
                        <p><i class="fa-solid fa-address-card"></i> <b>DNI:</b><?php echo "<input type='text' class='inputsname' id='dni_alu' name='dni_alumno' value='".$alumno_info['dni_alumno']."'></input>"?></p>
                    </div>
                    <div class="icon">
                    <small id="error_email" class="alerts"><b><i class="fa-solid fa-circle-exclamation"></i> Error en el campo Email </b></small>   
                        <p> <i class="fa-solid fa-square-envelope"></i> <b>Correo: </b><?php echo "<input type='text' id='e_mail' class='inputsname' name='email_alumno' value='".$alumno_info['email_alumno']."'></input>"?></p>
                    </div>
                   
                    <button type='submit'  onclick="modificaralumno()" name='info' id="info" class='btncrudmodificar-alu btn btn-primary'><i class='fa-solid fa-upload'></i> Modificar</button>
                   
                </form>
            </div>

            <div  class="column-notas">
                    <h1 style=text-align:center;>Notas <i class="fa-solid fa-clipboard-user"></i></h1>
                
                    <div  class="notas">
                    <table class="table table-bordered table-hover table-striped notas bordes">
                        <tr class="cabecera">
                            <td><b>Módulo</b></td>
                            <td><b>UF1</b></td>
                            <td><b>UF2</b></td>
                            <td><b>UF3</b></td>
                            <td><b>Media</b></td>
                        </tr>

                        <tr>
                            <td>M2 Bases de Datos <i class="fa-solid fa-database"></i></td>
                            <?php
                            for ($i=0; $i < count($alumno_notas); $i++) { 
                                if ($alumno_notas[$i][6] == 1) {
                                    echo "<form  action='./alumnos_controller.php' method='post'>";
                                    echo "<td><input type='number' name='m1-1' class='inputs' value='".$alumno_notas[$i][1]."'></td>";
                                    echo "<td><input type='number' name='m1-2' class='inputs' value='".$alumno_notas[$i][2]."'></td>";
                                    echo "<td><input type='number' name='m1-3' class='inputs' value='".$alumno_notas[$i][3]."'></td>";
                                    $media = round(($alumno_notas[$i][1] + $alumno_notas[$i][2] + $alumno_notas[$i][3])/3, 2);
                                    echo "<td>$media</td>";
                                    echo "<input type='hidden' name='m1-media' value='".$media."'>";  
                                }
                            }
                            ?>
                        </tr>

                        <tr>
                            <td>M3 Programación Básica <i class="fa-brands fa-php"></i></td>
                            <?php
                            for ($i=0; $i < count($alumno_notas); $i++) { 
                                if ($alumno_notas[$i][6] == 2) {
                                    echo "<td><input type='number' name='m2-1' class='inputs' value='".$alumno_notas[$i][1]."'></td>";
                                    echo "<td><input type='number' name='m2-2' class='inputs' value='".$alumno_notas[$i][2]."'></td>";
                                    echo "<td><input type='number' name='m2-3' class='inputs' value='".$alumno_notas[$i][3]."'></td>";
                                    $media = round(($alumno_notas[$i][1] + $alumno_notas[$i][2] + $alumno_notas[$i][3])/3, 2);
                                    echo "<td>$media</td>";
                                    echo "<input type='hidden' name='m2-media' value='".$media."'>";  
                                }
                            }
                            ?>
                        </tr>

                        <tr>
                            <td>M6 Desarrollo Web Cliente <i class="fa-brands fa-php"></i></td>
                            <?php
                            for ($i=0; $i < count($alumno_notas); $i++) { 
                                if ($alumno_notas[$i][6] == 3) {
                                    echo "<td><input type='number' name='m3-1' class='inputs' value='".$alumno_notas[$i][1]."'></td>";
                                    echo "<td><input type='number' name='m3-2' class='inputs' value='".$alumno_notas[$i][2]."'></td>";
                                    echo "<td><input type='number' name='m3-3' class='inputs' value='".$alumno_notas[$i][3]."'></td>";
                                    $media = round(($alumno_notas[$i][1] + $alumno_notas[$i][2] + $alumno_notas[$i][3])/3, 2);
                                    echo "<td>$media</td>";
                                    echo "<input type='hidden' name='m3-media' value='".$media."'>";  
                                }
                            }
                            ?>
                        </tr>

                        <tr>
                            <td>M7-123 Desarrollo Web Cliente <i class="fa-brands fa-html5"></i></td>
                            <?php
                            for ($i=0; $i < count($alumno_notas); $i++) { 
                                if ($alumno_notas[$i][6] == 4) {
                                    echo "<td><input type='number' name='m4-1' class='inputs' value='".$alumno_notas[$i][1]."'></td>";
                                    echo "<td><input type='number' name='m4-2' class='inputs' value='".$alumno_notas[$i][2]."'></td>";
                                    echo "<td><input type='number' name='m4-3' class='inputs' value='".$alumno_notas[$i][3]."'></td>";
                                    $media = round(($alumno_notas[$i][1] + $alumno_notas[$i][2] + $alumno_notas[$i][3])/3, 2);
                                    echo "<td>$media</td>";
                                    echo "<input type='hidden' name='m4-media' value='".$media."'>";     
                                }
                            }
                            ?>
                        </tr>

                        <tr>
                            <td>M7-4 Desarrollo Web Servidor  <i class="fa-brands fa-php"></i></td>
                            <?php
                            for ($i=0; $i < count($alumno_notas); $i++) { 
                                if ($alumno_notas[$i][6] == 5) {
                                    echo "<td><input type='number' name='m5-1' class='inputs' value='".$alumno_notas[$i][1]."'></td>";
                                    echo "<td><input type='number' name='m5-2' class='inputs' value='".$alumno_notas[$i][2]."'></td>";
                                    echo "<td><input type='number' name='m5-3' class='inputs' value='".$alumno_notas[$i][3]."'></td>";
                                    $media = round(($alumno_notas[$i][1] + $alumno_notas[$i][2] + $alumno_notas[$i][3])/3, 2);
                                    echo "<td>$media</td>";
                                    echo "<input type='hidden' name='m5-media' value='".$media."'>";                    
                                }
                            }
                            ?>
                        </tr>

                        <tr>
                            <td>M8 Despliegue Apps Web <i class="fa-brands fa-square-js"></i></td>
                            <?php
                            for ($i=0; $i < count($alumno_notas); $i++) { 
                                if ($alumno_notas[$i][6] == 6) {
                                    echo "<td><input type='number' name='m6-1' class='inputs' value='".$alumno_notas[$i][1]."'></td>";
                                    echo "<td><input type='number' name='m6-2' class='inputs' value='".$alumno_notas[$i][2]."'></td>";
                                    echo "<td><input type='number' name='m6-3' class='inputs' value='".$alumno_notas[$i][3]."'></td>";
                                    $media = round(($alumno_notas[$i][1] + $alumno_notas[$i][2] + $alumno_notas[$i][3])/3, 2);
                                    echo "<td>$media</td>";
                                    echo "<input type='hidden' name='m6-media' value='".$media."'>";
                                }
                            }
                            ?>
                        </tr>

                        <tr>
                            <td>M9 Diseño de Interfícies Web <i class="fa-solid fa-palette"></i></td>
                            <?php
                            for ($i=0; $i < count($alumno_notas); $i++) { 
                                if ($alumno_notas[$i][6] == 7) {
                                    echo "<td><input type='number' name='m7-1' class='inputs' value='".$alumno_notas[$i][1]."'></td>";
                                    echo "<td><input type='number' name='m7-2' class='inputs' value='".$alumno_notas[$i][2]."'></td>";
                                    echo "<td><input type='number' name='m7-3' class='inputs' value='".$alumno_notas[$i][3]."'></td>";
                                    $media = round(($alumno_notas[$i][1] + $alumno_notas[$i][2] + $alumno_notas[$i][3])/3, 2);
                                    echo "<td>$media</td>";
                                    echo "<input type='hidden' name='m7-media' value='".$media."'>";
                                }
                            }
                            ?>
                        </tr>

                        <tr>
                            <td>M12 Sintesis <i class="fa-solid fa-people-group"></i></td>
                            <?php
                            for ($i=0; $i < count($alumno_notas); $i++) { 
                                if ($alumno_notas[$i][6] == 8) {
                                    echo "<td><input type='number' name='m8-1' class='inputs' value='".$alumno_notas[$i][1]."'></td>";
                                    echo "<td><input type='number' name='m8-2' class='inputs' value='".$alumno_notas[$i][2]."'></td>";
                                    echo "<td><input type='number' name='m8-3' class='inputs' value='".$alumno_notas[$i][3]."'></td>";
                                    $media = round(($alumno_notas[$i][1] + $alumno_notas[$i][2] + $alumno_notas[$i][3])/3, 2);
                                    echo "<td>$media</td>";
                                    echo "<input type='hidden' name='m8-media' value='".$media."'>";                            }
                            }
                            ?>
                        </tr>
                    </table>
                </div>
                <?php
                // Botón para restuara valores de las notas, actualizando la página
                echo "<input type='hidden' name='id_alumno' value='".$id_alumno."'>"; 
                echo "<button  type='submit' id='notas' name='notas' class='btncrudmodificar-alu btn btn-primary'><i class='fa-solid fa-upload'></i> Actualizar notas</button>";
                echo "</form>";
                // Actualizar
                echo "<a href='form_alu_controller.php?id_alumno={$alumno_info['id_alumno']}'><button class='btncrudenviar btn btn-danger btn btn-primary'><i class='fa-solid fa-rotate-right'></i> Restaurar valores</button></a>";
                ?>
            </div>
        </div>
    </div>
    <?php
    if (isset($_GET['notasMod'])) {
        ?>
        <script>
        Swal.fire({
        background:'#443E53',
        color:'white',
        icon: 'success',
        iconColor:'#719972',
        title: 'NOTAS ACTULIZADAS!'
    })
          </script>
    <?php
    }
    ?>
    <?php
    if (isset($_GET['userMod'])) {
    ?>
        <script>
    Swal.fire({
        background:'#443E53',
        color:'white',
        icon: 'success',
        iconColor:'#719972',
        title: 'USUARIO ACTUALIZADO!'
    })
        </script>
        <?php
    }
    ?>
</body>

</html>

