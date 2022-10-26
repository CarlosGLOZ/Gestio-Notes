<?php


require_once '../config/config.php';
require_once '../config/conexion.php';
require_once 'func.php';

// echo sha1("1234");

// si la validación falla, volver a login.html
// if (!isset($_POST[EMAIL_VARNAME]) || !isset($_POST[PASSWORD_VARNAME])) {
//    echo "<script>window.location.href = '../view/login.html?val=false&val_fail_cause=unset_fields';</script>";
// }

// Comprobar que haya conexión con la base de datos

// recuperar datos evitando inyecctions HTML y JS y eliminando espacios en blanco del principio y el final
foreach ($_POST as $key => $value) {

    // encriptar contraseña
    if ($key == GESTOR['contra']) {
        $$key = sha1(trim(strip_tags($value)));
    } else {
        $$key = trim(strip_tags($value));
    }
}

// $GLOBALS[EMAIL_VARNAME] devuelve el valor de la variable cuyo nombre el el valor de EMAIL_VARNAME
if (!validar_email($GLOBALS[GESTOR['email']], $GLOBALS[GESTOR['contra']], $conexion)) {
    echo "<script>window.location.href = '../view/login.html?val=false&val_fail_cause=email';</script>";
}

// a partir de aquí el email ya está validado y el usuario se puede loguear
loguear($GLOBALS[GESTOR['email']], $conexion);

echo "<script>window.location.href = '../controller/index_controller.php';</script>";