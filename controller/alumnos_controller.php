<?php

// Recogemos el fichero del modelo
require_once "../model/alumno.php";
// Para poder pasarle la conexion como variable a la función
require_once '../config/conexion.php';

// Comprobamos que la sesion esta iniciada.
require_once '../proc/func.php';
validarSesion();

$id_alumno = $_POST['id_alumno'];

// Asegurar los campos que vamos a introducir en la base de datos:
$notasGlobal = [];

if (isset($_POST['notas'])) {
    foreach ($_POST as $key => $value) {
        $n_modu = explode('-', $key);
        for ($i=1; $i <= 8; $i++) { 
            if ($n_modu[0] == "m$i") {
                // Mirar y clasificar cada una de las uf
                if ($n_modu[1] == '1') {
                    if ($value > 10) {
                        $value = 10;
                    } else if ($value < 0) {
                        $value = 0;
                    }
                    $notasGlobal[$n_modu[0]]['uf1'] = mysqli_real_escape_string($conexion, trim(strip_tags($value)));      
                }
                if ($n_modu[1] == '2') {
                    if ($value > 10) {
                        $value = 10;
                    } else if ($value < 0) {
                        $value = 0;
                    }
                    $notasGlobal[$n_modu[0]]['uf2'] = mysqli_real_escape_string($conexion, trim(strip_tags($value))); 
                }
                if ($n_modu[1] == '3') {
                    if ($value > 10) {
                        $value = 10;
                    } else if ($value < 0) {
                        $value = 0;
                    }
                    $notasGlobal[$n_modu[0]]['uf3'] = mysqli_real_escape_string($conexion, trim(strip_tags($value)));   
                }
                if ($n_modu[1] == 'media') {
                    $notasGlobal[$n_modu[0]]['media'] = $value;
                }
            }
        }
    }
    // var_dump($notasGlobal);

    // Actualizar las notas del alumno, notas:
    Alumno::updateNotas($notasGlobal, $id_alumno, $conexion);

    echo "<script>location.href='../controller/form_alu_controller.php?id_alumno=$id_alumno&&notasMod=true'</script>";

} else if (isset($_POST['info'])) {
    foreach ($_POST as $key => $value) {
        $$key = mysqli_real_escape_string($conexion, trim(strip_tags($value)));
    }
    $letter = substr($dni_alumno, -1);
    $numbers = substr($dni_alumno, 0, -1);
if (empty($nombre_alumno) || empty($primer_apellido_alumno) || empty($segundo_apellido_alumno) || empty($email_alumno) || empty($dni_alumno)) {
    echo "<script>location.href='../controller/form_alu_controller.php?id_alumno=$id_alumno&&MaluserMod=true'</script>";
} else if (!filter_var($email_alumno, FILTER_VALIDATE_EMAIL)) {
      echo "<script>location.href='../controller/form_alu_controller.php?id_alumno=$id_alumno&&MaluserMod=true'</script>";
} else if ($dni_alumno==true ) {
   
  if (substr("TRWAGMYFPDXBNJZSQVHLCKE", $numbers%23, 1) == $letter && strlen($letter) == 1 && strlen ($numbers) == 8 ){
    // Actualizar los datos del alumno, información:
    Alumno::updateAlumno($id_alumno, $nombre_alumno, $primer_apellido_alumno, $segundo_apellido_alumno, $email_alumno, $dni_alumno, $conexion);
    echo "<script>location.href='../controller/form_alu_controller.php?id_alumno=$id_alumno&&userMod=true'</script>";
  } else {
    echo "<script>location.href='../controller/form_alu_controller.php?id_alumno=$id_alumno&&MaluserMod=true'</script>";
  }
}


   

    
}



?>


