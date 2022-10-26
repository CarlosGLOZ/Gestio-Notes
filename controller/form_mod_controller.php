<?php

require '../model/alumno.php';
require_once '../proc/func.php';

// Comprobamos que la sesion esta iniciada.
validarSesion();

$id_alumno = $_GET['id_alumno'];

$alumno = Alumno::getAlumnoId($id_alumno);

require_once '../view/modificar.php';