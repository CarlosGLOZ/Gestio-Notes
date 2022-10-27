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
    $email = trim(strip_tags($email));

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

function getURL()
{
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
         $url = "https://";
    else
         $url = "http://";
    // Append the host(domain name, ip) to the URL.
    $url.= $_SERVER['HTTP_HOST'];

    // Append the requested resource location to the URL
    $url.= $_SERVER['REQUEST_URI'];

    return $url;
}

function isGetSet()
{
    $url = getURL();

    $url_separada = explode('?',$url);

    if (!isset($url_separada[1])) {
        return false;
    }

    if ($url_separada[1] == '') {
        return false;
    }

    return true;
}

// Comprueba si hay variables GET vacías
function hayGetsVacios()
{
    $url = getURL();
    $url_partida = explode('?', $url);

    // separo la URL en dos por el '?', el primer valor será la url base y el segundo serán los valores GET
    // cojo los valores GET y los separo por el '&', esto me devuelve un array de todas las variables GET
    $variables_get = explode('&', $url_partida[1]);
    
    
    foreach ($variables_get as $value) {
        // separo cada variable por el '=', esto me devuelve el nombre de la variable y su valor
        // si el valor no está vacío, añadirlo a una string 
        if (explode('=', $value)[1] == '') {
            return true;
        }
    }

    return false;
}

function eliminarVariablesGetVacias($exclude=['filtro-buscar'])
{
    $url = getURL();
    $url_partida = explode('?', $url);

    // separo la URL en dos por el '?', el primer valor será la url base y el segundo serán los valores GET
    // cojo los valores GET y los separo por el '&', esto me devuelve un array de todas las variables GET
    $variables_get = explode('&', $url_partida[1]);

    $nuevo_array_variables_get = [];

    foreach ($variables_get as $value) {
        // separo cada variable por el '=', esto me devuelve el nombre de la variable y su valor
        // si el valor no está vacío, añadirlo a una string 
        if (explode('=', $value)[1] != '' && !in_array(explode('=', $value)[0], $exclude)) {
            array_push($nuevo_array_variables_get, $value);
        }
    }

    $nueva_url = $url_partida[0].'?'.implode('&', $nuevo_array_variables_get);

    return $nueva_url;
}