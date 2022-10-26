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
    <link rel="stylesheet" href="../static/css/entrar.css">
    <!-- LINK FONT AWESOME -->
    <script src="https://kit.fontawesome.com/2b5286e1aa.js" crossorigin="anonymous"></script>
    <!-- LINK GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet">
    <!-- LINK FAVICON -->
    <title>CRUD - CAHM</title>
</head>

<body>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <a class="enlace">
            <img src="../static/img/Logo login - pequeño.png" alt="Logo login - pequeño" class="logo-peq">
        </a>
        <a class="enlace">
            <img src="../static/img/Logo login - grande.png" alt="Logo login" class="logo">
        </a>
        <ul>
            <li><a href="../proc/cerrar_sesion.php">Cerrar sesión</a></li>
        </ul>
    </nav>
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
</body>

</html>