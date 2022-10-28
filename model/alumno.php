<?php

class Alumno{
    // ATRIBUTOS
    public $id_alumno;
    public $nombre_alumno;
    public $primer_apellido_alumno;
    public $segundo_apellido_alumno;
    public $email_alumno;
    public $dni_alumno;

    public function __construct($id_alumno, $nombre_alumno, $primer_apellido_alumno, $segundo_apellido_alumno, $email_alumno, $dni_alumno){
        // ASIGNAMOS VALORES A LOS ATRIBUTOS
        $this->id_alumno = $id_alumno;
        $this->nombre_alumno = $nombre_alumno;
        $this->primer_apellido_alumno = $primer_apellido_alumno;
        $this->segundo_apellido_alumno = $segundo_apellido_alumno;
        $this->email_alumno = $email_alumno;
        $this->dni_alumno = $dni_alumno;
    }

    public static function getAlumnos($conexion) {
        $sentencia = "SELECT * FROM ".ALUMNO['tabla'].";";
        $listado_alumnos = mysqli_query($conexion, $sentencia);

        // Devolvemos el listado de alumnos, para imprimirlo en el index_controller.
        return $listado_alumnos;

        // Cerrar statement
        mysqli_stmt_close($stmt);
    }

    public static function checkUser($conexion, $email_alumno) {
        $sql = "SELECT * FROM ".ALUMNO['tabla']." WHERE ".ALUMNO['email']." = '$email_alumno';";
        
        $id_usuarioExiste = mysqli_fetch_assoc(mysqli_query($conexion, $sql));
        var_dump($id_usuario);
        $usuarioExiste = mysqli_query($conexion, $sql);
        // var_dump($usuarioExiste -> num_rows);

        if($row = $usuarioExiste -> num_rows){
            $error = true;
        }else{
            $error = false;
        }
        return $error;
    }

    function errorEmail($email_alumno){
        if(!filter_var($email_alumno, FILTER_VALIDATE_EMAIL)){
            $error = true;
        }else{
            $error=false;
        }
        return $error;
    }

    public static function registroCamposVacios($nombre_alumno, $primer_apellido_alumno, $segundo_apellido_alumno, $email_alumno, $dni_alumno) {
        if(empty($nombre_alumno) || empty($primer_apellido_alumno) || empty($segundo_apellido_alumno) || empty($email_alumno) || empty($dni_alumno)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 
     */
    public static function createAlumno($nombre_alumno, $primer_apellido_alumno, $segundo_apellido_alumno, $email_alumno, $dni_alumno, $conexion) {

        $alumno = new Alumno (null,$nombre_alumno, $primer_apellido_alumno, $segundo_apellido_alumno, $email_alumno, $dni_alumno);

        $sentencia = "INSERT INTO ".ALUMNO['tabla']." (".ALUMNO['id'].", ".ALUMNO['nombre'].", ".ALUMNO['primer_apellido'].", ".ALUMNO['segundo_apellido'].", ".ALUMNO['email'].", ".ALUMNO['dni'].") VALUES (null, '$nombre_alumno', '$primer_apellido_alumno', '$segundo_apellido_alumno', '$email_alumno', '$dni_alumno');";
        // Ejecutamos la consulta del insert
        mysqli_query($conexion, $sentencia);

    }

    /**
     * 
     */
    public static function getAlumnoId($id_alumno, $conexion) {

        $sql = "SELECT * FROM ".ALUMNO['tabla']." WHERE ".ALUMNO['id']. " = '$id_alumno';";
        return mysqli_fetch_assoc(mysqli_query($conexion, $sql));
    }

    /**
     * 
     */
    public static function deleteAlumno($id_alumno, $conexion) {
        $sql = "DELETE FROM ".ALUMNO['tabla']." WHERE ".ALUMNO['id']." = $id_alumno;";
        // Ejecutamos la consulta del delete
        mysqli_query($conexion, $sql);
    }

    /**
     * 
     */
    public static function updateAlumno($id_alumno, $nombre_alumno, $primer_apellido_alumno, $segundo_apellido_alumno, $email_alumno, $dni_alumno, $conexion) {

        $sql = "UPDATE ".ALUMNO['tabla']." SET ".ALUMNO['nombre']." = '$nombre_alumno', ".ALUMNO['primer_apellido']." = '$primer_apellido_alumno', ".ALUMNO['segundo_apellido']." = '$segundo_apellido_alumno', ".ALUMNO['email']." = '$email_alumno', ".ALUMNO['dni']." = '$dni_alumno' WHERE id_alumno = $id_alumno";
        echo $sql;
        // Ejecutamos consulta para actualizar el usuario
        mysqli_query($conexion, $sql);
    }

}