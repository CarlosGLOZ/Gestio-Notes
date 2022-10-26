<?php

require_once '../model/alumno.php';
require_once '../config/config.php';
require_once '../config/conexion.php';

require_once '../proc/func.php';
// Comprobamos que la sesion esta iniciada.
validarSesion();

$nombre_alumno = $conexion -> real_escape_string(trim(strip_tags($_POST['nombre'])));
$primer_apellido_alumno = $conexion -> real_escape_string(trim(strip_tags($_POST['primer_apellido'])));
$segundo_apellido_alumno = $conexion -> real_escape_string(trim(strip_tags($_POST['segundo_apellido'])));
$email_alumno = $conexion -> real_escape_string(trim(strip_tags($_POST['email'])));
$dni_alumno = $conexion -> real_escape_string(trim(strip_tags($_POST['dni'])));

Alumno::createAlumno($nombre_alumno,$primer_apellido_alumno, $segundo_apellido_alumno, $email_alumno, $dni_alumno);

// echo "<script>location.href='../controller/index_controller.php'</script>";