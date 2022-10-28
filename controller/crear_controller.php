<?php

require_once '../model/alumno.php';
require_once '../config/conexion.php';

require_once '../proc/func.php';
// Comprobamos que la sesion esta iniciada.
validarSesion();

foreach ($_POST as $key => $value) {
    $$key = mysqli_real_escape_string($conexion, trim(strip_tags($value)));
}

Alumno::createAlumno($conexion, $GLOBALS[ALUMNO['nombre']], $GLOBALS[ALUMNO['primer_apellido']], $GLOBALS[ALUMNO['segundo_apellido']], $GLOBALS[ALUMNO['email']], $GLOBALS[ALUMNO['dni']]);

echo "<script>location.href='index_controller.php'</script>";