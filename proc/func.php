<?php

// validar que el correo y la constraseña son correctos
function validar_email($email, $password, $conexion)
{
    $email = $conexion -> real_escape_string($email);
    $email = trim(strip_tags($email));
    // $password = $conexion -> real_escape_string($password);
    
    $stmt = "SELECT ".PASSWORD_VARNAME." FROM ".TABLA_USUARIOS." WHERE ".EMAIL_VARNAME." = '$email';";
    
    // echo $stmt;
    $results = mysqli_query($conexion, $stmt);
    // var_dump($results);
    // var_dump($conexion);
    // die();

    $account_password = mysqli_fetch_assoc($results)[PASSWORD_VARNAME];

    // echo $password."<br>";
    // echo $account_password;

    if ($password == $account_password) {
        return true;
    }
    return false;
}

function loguear($email, $conexion)
{
    $email = $conexion -> real_escape_string($email);
    $email = trim(strip_tags($email));

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


function getModulos($conexion)
{
    $stmt = "SELECT * FROM tbl_modulo";

    // $modulos = mysqli_fetch_assoc(mysqli_query($conexion, $stmt));
    $modulos = mysqli_query($conexion, $stmt);

    return $modulos;
}

function getEmailAlumnosDeModulo($modulo, $conexion)
{
    $lista_alumnos = [];

    $stmt = "SELECT email_alumno FROM tbl_alumno INNER JOIN tbl_alumno_modulo ON tbl_alumno.id_alumno = tbl_alumno_modulo.id_Alumno WHERE tbl_alumno_modulo.id_Modulo = $modulo;";

    $alumnos = mysqli_query($conexion, $stmt);

    foreach ($alumnos as $key => $array) {
        # code...
        foreach ($array as $key => $value) {
            // echo "[".$key."] -> [".$value."]<br>";
            array_push($lista_alumnos, $value);
        }
    }

    return $lista_alumnos;
}