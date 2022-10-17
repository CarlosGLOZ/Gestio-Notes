<?php

// validar que el correo y la constraseña son correctos
function validar_email($email, $password, $conexion)
{
    $email = $conexion -> real_escape_string($email);
    $password = $conexion -> real_escape_string($password);

    $stmt = "SELECT ".PASSWORD_VARNAME." FROM ".TABLA_USUARIOS." WHERE ".EMAIL_VARNAME." = '$email';";

    $account_password = mysqli_fetch_assoc(mysqli_query($conexion, $stmt))[PASSWORD_VARNAME];

    if ($password == $account_password) {
        return true;
    }
    return false;
}

function loguear($email, $conexion)
{
    $email = $conexion -> real_escape_string($email);

    $stmt = "SELECT * FROM ".TABLA_USUARIOS." WHERE ".EMAIL_VARNAME." = '$email';";

    $registro_usuario = mysqli_fetch_assoc(mysqli_query($conexion, $stmt));

    session_start();
    // foreach ($registro_usuario as $key => $value) {
    //     $_SESSION[$key] = $value;
    //     // echo "[".$key."] -> [".$value."]<br>";
    // }

    $_SESSION[NOMBRE_VARNAME] = $registro_usuario[NOMBRE_VARNAME];
    $_SESSION[APELLIDOS_VARNAME] = $registro_usuario[APELLIDOS_VARNAME];
    $_SESSION[EMAIL_VARNAME] = $registro_usuario[EMAIL_VARNAME];

    // foreach ($_SESSION as $key => $value) {
    //     echo "[".$key."] -> [".$value."]<br>";
    // }
}
