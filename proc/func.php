<?php

// validar que el correo y la constraseña son correctos
function validar_email($email, $password, $conexion)
{
    $email = $conexion -> real_escape_string($email);
    $password = $conexion -> real_escape_string($password);

    $stmt = "SELECT ".GESTOR['contra']." FROM ".GESTOR['tabla']." WHERE ".GESTOR['email']." = '$email';";

    $account_password = mysqli_fetch_assoc(mysqli_query($conexion, $stmt))[GESTOR['contra']];

    if ($password == $account_password) {
        return true;
    }
    return false;
}

function loguear($email, $conexion)
{
    $email = $conexion -> real_escape_string($email);

    $stmt = "SELECT * FROM ".GESTOR['tabla']." WHERE ".GESTOR['email']." = '$email';";

    $registro_usuario = mysqli_fetch_assoc(mysqli_query($conexion, $stmt));

    session_start();
    // foreach ($registro_usuario as $key => $value) {
    //     $_SESSION[$key] = $value;
    //     // echo "[".$key."] -> [".$value."]<br>";
    // }

    $_SESSION[GESTOR['nombre']] = $registro_usuario[GESTOR['nombre']];
    $_SESSION[GESTOR['email']] = $registro_usuario[GESTOR['email']];
    $_SESSION[GESTOR['contra']] = $registro_usuario[GESTOR['contra']];

    // foreach ($_SESSION as $key => $value) {
    //     echo "[".$key."] -> [".$value."]<br>";
    // }
}


function validarSesion() {
    require_once '../config/config.php';

    session_start();
    if (!isset($_SESSION[GESTOR['email']])) {
        echo "<script>window.location.href = '../view/login.html?error=errorSesion';</script>";
    }
}

function getModulos($conexion)
{
    $stmt = "SELECT * FROM ".MODULO['tabla'].";";

    // $modulos = mysqli_fetch_assoc(mysqli_query($conexion, $stmt));
    $modulos = mysqli_query($conexion, $stmt);

    return $modulos;
}

function getEmailAlumnosDeModulo($modulo, $conexion)
{
    $lista_alumnos = [];

    $stmt = "SELECT ".ALUMNO['email']." FROM ".ALUMNO['tabla']." INNER JOIN ".ALUMNO_MODULO['tabla']." ON ".ALUMNO['tabla'].".".ALUMNO['id']." = ".ALUMNO_MODULO['tabla'].".".ALUMNO_MODULO['id_alumno']." WHERE ".ALUMNO_MODULO['tabla'].".".ALUMNO_MODULO['id_modulo']." = $modulo;";

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