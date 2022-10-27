<?php

require_once '../model/alumno.php';
require_once '../config/conexion.php';

require_once '../proc/func.php';
// Comprobamos que la sesion esta iniciada.
validarSesion();

// $nombre_alumno = $conexion -> real_escape_string(trim(strip_tags($_POST['nombre'])));
// $primer_apellido_alumno = $conexion -> real_escape_string(trim(strip_tags($_POST['primer_apellido'])));
// $segundo_apellido_alumno = $conexion -> real_escape_string(trim(strip_tags($_POST['segundo_apellido'])));
// $email_alumno = $conexion -> real_escape_string(trim(strip_tags($_POST['email'])));
// $dni_alumno = $conexion -> real_escape_string(trim(strip_tags($_POST['dni'])));

foreach ($_POST as $key => $value) {
    $$key = mysqli_real_escape_string($conexion, trim(strip_tags($value)));
    // echo $key."<br>";
}

// echo $GLOBALS[ALUMNO['nombre']];

Alumno::createAlumno($conexion, $GLOBALS[ALUMNO['nombre']], $GLOBALS[ALUMNO['primer_apellido']], $GLOBALS[ALUMNO['segundo_apellido']], $GLOBALS[ALUMNO['email']], $GLOBALS[ALUMNO['dni']]);
die();
// echo "<script>location.href='index_controller.php'</script>";