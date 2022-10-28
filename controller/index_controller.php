<?php

// Recogemos el fichero del modelo
require_once "../model/alumno.php";
// Para poder pasarle la conexion como variable a la función
require_once '../config/conexion.php';

// Comprobamos que la sesion esta iniciada.
require_once '../proc/func.php';
validarSesion();

// Imprimimos todos los registros con el método creado anteriormente en la clase Alumno.
$listado_alumnos = Alumno::getAlumnos($conexion);

// Controllar que no nos entren a los views y vengan directos a los controllers, donde ya se les valida la sesión, en el caso de no tenerla
$entrada_valida = true;

require_once '../view/principal.php';