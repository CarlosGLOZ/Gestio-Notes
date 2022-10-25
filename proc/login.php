<?php


require_once '../config/config.php';
require_once '../config/conexion.php';
require_once 'func.php';

// echo sha1("1234");

// si la validación falla, volver a login.html
// if (!isset($_POST[EMAIL_VARNAME]) || !isset($_POST[PASSWORD_VARNAME])) {
//    echo "<script>window.location.href = '../view/login.html?val=false&val_fail_cause=unset_fields';</script>";
// }

// recuperar datos evitando inyecctions HTML y JS y eliminando espacios en blanco del principio y el final
foreach ($_POST as $key => $value) {

    // encriptar contraseña
    if ($key == PASSWORD_VARNAME) {
        $$key = sha1(trim(strip_tags($value)));
    } else {
        $$key = trim(strip_tags($value));
    }
    // echo "[".$key."] -> [".$GLOBALS[$key]."]<br>";
    // echo $GLOBALS[$key]."<br>";
}

// $GLOBALS[EMAIL_VARNAME] devuelve el valor de la variable cuyo nombre el el valor de EMAIL_VARNAME
// echo $GLOBALS[EMAIL_VARNAME]."<br>";
// echo $GLOBALS[PASSWORD_VARNAME]."<br>";
// var_dump($conexion);

if (!validar_email($GLOBALS[EMAIL_VARNAME], $GLOBALS[PASSWORD_VARNAME], $conexion)) {
    echo "<script>window.location.href = '../view/login.html?val=false&val_fail_cause=email';</script>";
}

// a partir de aquí el email ya está validado y el usuario se puede loguear
$nombre = $_POST['email_gestor'];

loguear($GLOBALS[EMAIL_VARNAME], $conexion);

echo "<script>window.location.href = '../view/principal.php';</script>";