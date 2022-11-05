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
    <link rel="stylesheet" href="../static/css/notas.css">
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
            echo "<script>window.location.href='../controller/notas_controller.php'</script>";
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
        <p class="bienvenida"> | Bienvenido <?php echo "<b>".$_SESSION[GESTOR['nombre']]."</b>" ?></p>
        <ul>
            <li><a href="../proc/cerrar_sesion.php">Cerrar sesión</a></li>
        </ul>
    </nav>

<div class="general">
    
<a href="../controller/index_controller.php?" class="atras"><button class="dark"><label><i class="fa-solid fa-arrow-left"></i></label></button></a> <!--atras-->
        <div class="titulonotas">

            <b><h1 style="text-align:center;" ><i class="fa-solid fa-book-bookmark"></i> Estadísticas </h1></b>
        </div>

        <div  class="notas-column"> 

                <div class="notasestadisticas">
                    <table  class="table table-dark table-striped">
                        <tr>
                            <th>Módulo</th>
                            <th>Mejores alumnos</th>
                            <th>Media</th>
                        </tr>

                        <!-- Recorremos todos los modulos -->
                        <?php
                        foreach ($modulos as $modulo) {
                            echo 
                            "
                                <tr>
                                    <td>
                                        ".$modulo['nombre_modulo']."
                                    </td>
                                    <td>";
                                        foreach ($modulo['mejores_alumnos'] as $alumno) {
                                            echo "<p><i class='fa-solid fa-graduation-cap'></i> <a class='alu-name-link' href='form_alu_controller.php?id_alumno=".$alumno[ALUMNO['id']]."'>".$alumno[ALUMNO['nombre']]." ".$alumno[ALUMNO['primer_apellido']]."</a> - ".$alumno[ALUMNO_MODULO['nota_final']]."</p>";
                                        }
                            echo    "</td>
                                    <td>
                                        ".round($modulo['nota_media'], 2)."
                                    </td>
                                </tr>
                            ";
                        }
                        ?>
                    </table>

                </div>
        </div>

</div>

</body>
</html>