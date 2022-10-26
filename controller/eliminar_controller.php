<?php

require_once '../model/alumno.php';
require_once '../proc/func.php';

// Comprobamos que la sesion esta iniciada.
validarSesion();

$id = $_GET['id'];

Alumno::deleteAlumno($id);

echo "<script>location.href='../controller/index_controller.php'</script>";