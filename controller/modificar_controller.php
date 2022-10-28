<?php

// Recogemos el fichero del modelo
require_once "../model/alumno.php";
// Para poder pasarle la conexion como variable a la función
require_once '../config/conexion.php';

// Comprobamos que la sesion esta iniciada.
require_once '../proc/func.php';
validarSesion();

// Si no entramos aqui desde el boton nos echa para atrás
if(!isset($_POST['modificar'])){
    echo "<script>window.location.href='../controller/index_controller.php?error=entradaInvalida'</script>";
    exit();
}

// Asegurar los campos que vamos a introducir en la base de datos:
foreach ($_POST as $key => $value) {
    $$key = mysqli_real_escape_string($conexion, trim(strip_tags($value)));
    // echo $key."<br>";
}

// VALIDACIONES:
// Comprobar que no queden campos vacios
if(Alumno::registroCamposVacios($nombre_alumno,$primer_apellido_alumno, $segundo_apellido_alumno, $email_alumno, $dni_alumno) !== FALSE){
    echo "<script>window.location.href='../controller/index_controller.php?error=camposVacios'</script>";
    exit();
}
// Comprobamos que el usuario no este ya creado
if(Alumno::checkUser($conexion, $email_alumno) != true){
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