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

// Controllar que no nos entren a los views y vengan directos a los controllers, donde ya se les valida la sesión, en el caso de no tenerla
$entrada_valida = true;

// Llamar a notas.php
require_once '../view/notas.php';