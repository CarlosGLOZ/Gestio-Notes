<?php

// Recogemos el fichero del modelo
require_once "../model/alumno.php";
// Para poder pasarle la conexion como variable a la función
require_once '../config/conexion.php';

// Comprobamos que la sesion esta iniciada.
require_once '../proc/func.php';
validarSesion();

$id_alumno = $_GET['id_alumno'];

// Función para recoger la información de ese usuario en concreto
$alumno_info = Alumno::getAlumnoId($id_alumno, $conexion);
// Función para recoger las notas de ese usuario en concreto, que recogemos al darle al modificar del crud de alumnos
$alumno_notas = Alumno::getNotasAlumno($id_alumno, $conexion);

// Controllar que no nos entren a los views y vengan directos a los controllers, donde ya se les valida la sesión, en el caso de no tenerla
$entrada_valida = true;

require_once '../view/alumnos.php';