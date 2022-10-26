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

    public static function getAlumnos() {
        require_once '../config/conexion.php';

        $sentencia = "SELECT * FROM ".ALUMNO['tabla'].";";
        $listado_alumnos = mysqli_query($conexion, $sentencia);

        // Devolvemos el listado de alumnos, para imprimirlo en el index_controller.
        return $listado_alumnos;

        // Cerrar statement
        mysqli_stmt_close($stmt);
    }

    public static function getAlumnosEmail() {
        require_once '../config/config.php';
        require_once '../config/conexion.php';

        $sentencia = "SELECT ".ALUMNO['email']." FROM ".ALUMNO['tabla'].";";
        $listado_alumnos = mysqli_query($conexion, $sentencia);

        return $correos_alumnos;
    }

    /**
     * 
     */
    public static function createAlumno($nombre_alumno, $primer_apellido_alumno, $segundo_apellido_alumno, $email_alumno, $dni_alumno) {
        require_once '../config/conexion.php';

        $alumno = new Alumno (null,$nombre_alumno, $primer_apellido_alumno, $segundo_apellido_alumno, $email_alumno, $dni_alumno);

        $sentencia = "INSERT INTO ".ALUMNO['tabla']." (".ALUMNO['id'].", ".ALUMNO['nombre'].", ".ALUMNO['primer_apellido'].", ".ALUMNO['segundo_apellido'].", ".ALUMNO['email'].", ".ALUMNO['dni'].") VALUES ($nombre_alumno, $primer_apellido_alumno, $segundo_apellido_alumno, $email_alumno, $dni_alumno);";
        $insert_user = mysqli_query($conexion, $sentencia);
    }

    /**
     * 
     */
    public static function getAlumnoId($id_alumno) {
        require_once '../config/config.php';
        require_once '../config/conexion.php';

        $sql = "SELECT * FROM ".ALUMNO['tabla']." WHERE ".ALUMNO['id']. " = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $id_alumno);
        $stmt->execute();

        $alumno = $stmt->fetch(PDO::FETCH_ASSOC);
        return $alumno;
    }

    /**
     * 
     */
    public static function deleteAlumno($id_alumno) {
        require_once '../config/config.php';
        require_once '../config/conexion.php';

        $sql = "DELETE FROM `tbl_alumnos` WHERE id_alumno = ?;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $id_alumno);
        $stmt->execute();
    }

    /**
     * 
     */
    public static function updateAlumno($id_alumno,$nombre_alumno,$edad_alumno) {
        require_once '../config/config.php';
        require_once '../config/conexion.php';

        $sql = "UPDATE `tbl_alumnos` SET `nombre_alumno` = ?, `edad_alumno` = ? WHERE id_alumno = ?";
        $stmt = $pdo->prepare($sql);

        // Guardamos los valores nuevos en el bindParam (!!PONER EL MISMO ORDEN QUE ARRIBA!!)
        $stmt->bindParam(1, $nombre_alumno);
        $stmt->bindParam(2, $edad_alumno);
        $stmt->bindParam(3, $id_alumno);
        $stmt->execute(); // Ejecutamos la sentencia en la base de datos...
    }

}