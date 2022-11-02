<?php
// Recogemos el fichero del modelo
require_once '../config/conexion.php';
require_once "../model/alumno.php";
// Para poder pasarle la conexion como variable a la función
require_once '../config/conexion.php';


// Comprobamos que la sesion esta iniciada.
require_once '../proc/func.php';
validarSesion();

// Establezco valores por defecto para los filtros
$filtro_nombre = '';
$filtro_apellidos = '';
$filtro_email = '';
$filtro_dni = '';
$filtro_limite = 5;
$pagina = 1;

if (isGetSet()) {
    if (hayGetsVacios()) {
        // Generamos una URL sin las variables GET vacías para hacerlo más limpio
        $nueva_url = eliminarVariablesGetVacias();
        // echo $nueva_url;
        echo "<script>window.location.href = '$nueva_url';</script>";
        exit();
    }

    // Recuperar filtros de GET
    foreach ($_GET as $key => $value) {
        $nombre_campo_separado = explode('-', $key);
        
        if ($nombre_campo_separado[0] == 'filtro') {
            // filtro-nombre, filtro-apellidos, filtro-email, filtro-dni
            $nombre_campo_junto = implode('_', $nombre_campo_separado);
            $$nombre_campo_junto = $value;
        } else {
            $$key = $value;
        }
    }
}


// Recogemos todos los registros con el método creado anteriormente en la clase Alumno.
$listado_alumnos = Alumno::getAlumnos($conexion, $filtro_nombre, $filtro_apellidos, $filtro_email, $filtro_dni, $filtro_limite, $pagina);

// recoger numero de alumnos que estamos mostrando
// $cantidad_alumnos_visibles = Alumno::getCantidadAlumnosVisibles($conexion, $listado_alumnos);
$cantidad_alumnos_visibles = $filtro_limite;

// recoger la cantidad todal de alumnos para la paginación
$total_alumnos = Alumno::getCantidadAlumnosVisibles($conexion, $filtro_nombre, $filtro_apellidos, $filtro_email, $filtro_dni);

// recogemos la url actual para los links de la paginación
$url_actual = getURL();

// Controllar que no nos entren a los views y vengan directos a los controllers, donde ya se les valida la sesión, en el caso de no tenerla
$entrada_valida = true;

require_once '../view/principal.php';