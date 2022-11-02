<?php
// Recogemos el fichero del modelo
require_once '../config/conexion.php';
require_once '../model/alumno.php';


// Comprobamos que la sesion esta iniciada.
require_once '../proc/func.php';
validarSesion();

// Recoger un array de todos los modulos
$modulos = [];

foreach (getModulos($conexion) as $value) {
    $value['mejores_alumnos'] = Alumno::getMejoresAlumnosModulo($conexion, $value['id_modulo'], 3);
    $value['nota_media'] = Alumno::getNotaMediaModulo($conexion, $value['id_modulo']);

    // Pushear el array asociativo del modulo al array de mosulos
    array_push($modulos, $value);
}


// Llamar a notas.php
require_once '../view/notas.php';