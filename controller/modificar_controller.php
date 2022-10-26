<?php

require_once '../model/alumno.php';
require_once '../proc/func.php';

// Comprobamos que la sesion esta iniciada.
validarSesion();

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$edad = $_POST['edad'];

Alumno::updateAlumno($id,$nombre,$edad);

echo "<script>location.href='../controller/index_controller.php'</script>";
?>


