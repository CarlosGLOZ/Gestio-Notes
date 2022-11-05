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

// genera una nueva url cambiando los valores get especificados por un valor dado
function cambiarVariableGet($url, $var, $value)
{
  
    $exploded_url = explode('?', $url);

    // ELIMINAR SWEETALERTS PARA QUE NO SALTEN TODO EL RATO AL CAMBIAR DE PÁGINA

    $eliminar_1="error=checkUser&";

    $modificar_1=trim($exploded_url[1],$eliminar_1);
    $exploded_url[1]= $modificar_1;



    $eliminar_2="error=checkUserDNI&";

    $modificar_2=trim($exploded_url[1],$eliminar_2);
    $exploded_url[1]= $modificar_2;

    $eliminar_3="error=errorEmail&";

    $modificar_3=trim($exploded_url[1],$eliminar_3);
    $exploded_url[1]= $modificar_3;

    $eliminar_4="create=true&";
    $modificar_4=trim($exploded_url[1],$eliminar_4);
    $exploded_url[1]= $modificar_4;

    $eliminar_5="correo_enviado=correo_enviado";
    $modificar_5=trim($exploded_url[1],$eliminar_5);
    $exploded_url[1]= $modificar_5;



    if (count($exploded_url) == 1) { // si no hay variables get establecidas
        return $url.'?'.$var.'='.$value;
    }

    if ($exploded_url[1] == '') {
        
        return $url.$var.'='.$value;
    }

    $gets = explode('&', $exploded_url[1]);
    
    // if (count($gets) == 1) { // si no hay variables get establecidas
    //     $exploded_get = explode('=', $gets[0]);
    //     if ($exploded_get[0] == $var)
    //     {
    //         $gets = "$var=$value";
    //     } else {
    //         $gets = $gets."&$var=$value";
    //     }
    // } else {
        $match = false;
        for ($i=0; $i < count($gets); $i++) {
            $exploded_get = explode('=', $gets[$i]);
            if ($exploded_get[0] == $var)
            {
                
                    $gets[$i] = "$var=$value";
                    $match = true;
                
               
            }
        }
        if (!$match) {
          
            array_push($gets,"$var=$value");
        }
      
        $gets = implode('&', $gets);
    // }
    
    $imploded_url = $exploded_url[0].'?'.$gets;

    return $imploded_url;
}




