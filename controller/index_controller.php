<?php

// Recogemos el fichero del modelo
require_once "../model/alumno.php";
require_once '../proc/func.php';

// Comprobamos que la sesion esta iniciada.
validarSesion();

// Imprimimos todos los registros con el método creado anteriormente en la clase Alumno.
$listado_alumnos = Alumno::getAlumnos();

require_once '../view/entrar.php';