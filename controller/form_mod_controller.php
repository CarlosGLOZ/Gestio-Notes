<?php

// Recogemos el fichero del modelo
require_once "../model/alumno.php";
// Para poder pasarle la conexion como variable a la función
require_once '../config/conexion.php';

// Comprobamos que la sesion esta iniciada.
require_once '../proc/func.php';
validarSesion();

$id_alumno = $_GET['id_alumno'];

$alumno_e = Alumno::getAlumnoId($id_alumno, $conexion);

require_once '../view/modificar.php';