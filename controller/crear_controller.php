<?php

// Para poder pasarle la conexion como variable a la función
require_once '../config/conexion.php';

// Comprobamos que la sesion esta iniciada.
require_once '../proc/func.php';
validarSesion();

require_once '../model/alumno.php';

// Si no entramos aqui desde el boton nos echa para atrás
if(!isset($_POST['registro'])){
    echo "<script>window.location.href='../controller/index_controller.php?error=entradaInvalida'</script>";
    exit();
}

// Asegurar los campos que vamos a introducir en la base de datos:
foreach ($_POST as $key => $value) {
    $$key = mysqli_real_escape_string($conexion, trim(strip_tags($value)));
}

// VALIDACIONES:
// Comprobar que no queden campos vacios
if(Alumno::registroCamposVacios($nombre_alumno,$primer_apellido_alumno, $segundo_apellido_alumno, $email_alumno, $dni_alumno) !== FALSE){
    echo "<script>window.location.href='../controller/index_controller.php?error=camposVacios'</script>";
    exit();
}
// Comprobamos que el usuario no este ya creado
if(Alumno::checkUser($conexion, $email_alumno) !== FALSE){
    echo "<script>window.location.href='../controller/index_controller.php?error=checkUser'</script>";
    exit();
}
if(Alumno::checkDNI($conexion, $dni_alumno) !== FALSE){
    echo "<script>window.location.href='../controller/index_controller.php?error=checkUserDNI'</script>";
    exit();
}
// Error email, formato invalido
if(Alumno::errorEmail($email_alumno) !== FALSE){
    echo "<script>window.location.href='../controller/index_controller.php?error=mal'</script>";
    exit();
}


$letter = substr($dni_alumno, -1);
$numbers = substr($dni_alumno, 0, -1);
 if (!filter_var($email_alumno, FILTER_VALIDATE_EMAIL)) {
    echo "<script>window.location.href='../controller/index_controller.php?error=mal'</script>";
} else if ($dni_alumno==true ) {
    if (substr("TRWAGMYFPDXBNJZSQVHLCKE", $numbers%23, 1) == $letter && strlen($letter) == 1 && strlen ($numbers) == 8 ){
        // Actualizar los datos del alumno, información:
        Alumno::createAlumno($conexion, $GLOBALS[ALUMNO['nombre']], $GLOBALS[ALUMNO['primer_apellido']], $GLOBALS[ALUMNO['segundo_apellido']], $GLOBALS[ALUMNO['email']], $GLOBALS[ALUMNO['dni']]);
        echo "<script>location.href='index_controller.php?create=true'</script>";
    } else {
        echo "<script>window.location.href='../controller/index_controller.php?error=mal'</script>";
    }
}