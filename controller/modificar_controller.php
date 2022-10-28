<?php

// Recogemos el fichero del modelo
require_once "../model/alumno.php";
// Para poder pasarle la conexion como variable a la función
require_once '../config/conexion.php';

// Comprobamos que la sesion esta iniciada.
require_once '../proc/func.php';
validarSesion();

$id_alumno = $_POST['id'];
$nombre_alumno = $conexion -> real_escape_string(trim(strip_tags($_POST['nombre'])));
$primer_apellido_alumno = $conexion -> real_escape_string(trim(strip_tags($_POST['primer_apellido'])));
$segundo_apellido_alumno = $conexion -> real_escape_string(trim(strip_tags($_POST['segundo_apellido'])));
$email_alumno = $conexion -> real_escape_string(trim(strip_tags($_POST['email'])));
$dni_alumno = $conexion -> real_escape_string(trim(strip_tags($_POST['dni'])));

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

// Error email, formato invalido
if(Alumno::errorEmail($email_alumno) !== FALSE){
    echo "<script>window.location.href='../controller/index_controller.php?error=errorEmail'</script>";
    exit();
}

Alumno::updateAlumno($id_alumno, $nombre_alumno, $primer_apellido_alumno, $segundo_apellido_alumno, $email_alumno, $dni_alumno, $conexion);

echo "<script>location.href='../controller/index_controller.php'</script>";
?>


