<?php

// Recogemos el fichero del modelo
require_once "../model/alumno.php";
// Para poder pasarle la conexion como variable a la función
require_once '../config/conexion.php';

// Comprobamos que la sesion esta iniciada.
require_once '../proc/func.php';
validarSesion();

$id_alumno = $_GET['id_alumno'];

echo Alumno::deleteAlumno($id_alumno, $conexion);

echo "<script>location.href='../controller/index_controller.php?'</script>";