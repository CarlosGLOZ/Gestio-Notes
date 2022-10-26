<?php

// Recogemos el fichero del modelo
require_once "../model/alumno.php";
require_once '../proc/func.php';


// Comprobamos que la sesion esta iniciada.
validarSesion();

// Establezco valores por defecto para los filtros
$filtro_nombre = '';
$filtro_apellidos = '';
$filtro_email = '';
$filtro_dni = '';

if (isGetSet()) {

    if (hayGetsVacios()) {
        // Generamos una URL sin las variables GET vacías para hacerlo más limpio
        $nueva_url = eliminarVariablesGetVacias();
        echo $nueva_url;
        echo "<script>window.location.href = '$nueva_url';</script>";
    }

    // Recuperar filtros de GET
    foreach ($_GET as $key => $value) {
        $nombre_campo_separado = explode('-', $key);
        
        if ($nombre_campo_separado[0] == 'filtro') {
            // filtro-nombre, filtro-apellidos, filtro-email, filtro-dni
            $nombre_campo_junto = implode('_', $nombre_campo_separado);
            $$nombre_campo_junto = $value;
        }
    }
}


// Imprimimos todos los registros con el método creado anteriormente en la clase Alumno.
$listado_alumnos = Alumno::getAlumnos($filtro_nombre, $filtro_apellidos, $filtro_email, $filtro_dni);

// Controllar que no nos entren a los views y vengan directos a los controllers, donde ya se les valida la sesión, en el caso de no tenerla
$entrada_valida = true;

require_once '../view/principal.php';