<?php

class Alumno{
    // ATRIBUTOS
    private $id_alumno;
    private $nombre_alumno;
    private $primer_apellido_alumno;
    private $segundo_apellido_alumno;
    private $email_alumno;
    private $dni_alumno;

    // Getters y setters
    public function getId()
    {
        return $this->id_alumno;
    }
    public function getNombre()
    {
        return $this->nombre_alumno;
    }
    public function getPrimerApellido()
    {
        return $this->primer_apellido_alumno;
    }
    public function getSegundoApellido()
    {
        return $this->segundo_apellido_alumno;
    }
    public function getEmail()
    {
        return $this->email_alumno;
    }
    public function getDni()
    {
        return $this->dni_alumno;
    }

    
    public function setId($value)
    {
        $this->id_alumno = $value;
        return $this->id_alumno == $value;
    }
    public function setNombre($value)
    {
        $this->nombre_alumno = $value;
        return $this->nombre_alumno == $value;
    }
    public function setPrimerApellido($value)
    {
        $this->primer_apellido_alumno = $value;
        return $this->primer_apellido_alumno == $value;
    }
    public function setSegundoApellido($value)
    {
        $this->segundo_apellido_alumno = $value;
        return $this->segundo_apellido_alumno == $value;
    }
    public function setEmail($value)
    {
        $this->email_alumno = $value;
        return $this->email_alumno == $value;
    }
    public function setDni($value)
    {
        $this->dni_alumno = $value;
        return $this->dni_alumno == $value;
    }

    public function __construct($id_alumno, $nombre_alumno, $primer_apellido_alumno, $segundo_apellido_alumno, $email_alumno, $dni_alumno){
        // ASIGNAMOS VALORES A LOS ATRIBUTOS
        $this->id_alumno = $id_alumno;
        $this->nombre_alumno = $nombre_alumno;
        $this->primer_apellido_alumno = $primer_apellido_alumno;
        $this->segundo_apellido_alumno = $segundo_apellido_alumno;
        $this->email_alumno = $email_alumno;
        $this->dni_alumno = $dni_alumno;
    }

    public static function getAlumnos($conexion, $filtro_nombre='', $filtro_apellidos='', $filtro_email='', $filtro_dni='') {

        // sentencia inclusiva de los filtros
        $sentencia = 
        "SELECT * FROM ".ALUMNO['tabla']." 
        WHERE ".ALUMNO['nombre']." LIKE '%".$filtro_nombre."%' 
        AND (".ALUMNO['primer_apellido']." LIKE '%".$filtro_apellidos."%'
        OR ".ALUMNO['segundo_apellido']." LIKE '%".$filtro_apellidos."%')
        AND ".ALUMNO['email']." LIKE '%".$filtro_email."%'
        AND ".ALUMNO['dni']." LIKE '%".$filtro_dni."%'
        ;";

        // echo $sentencia;
        // die();
        
        $listado_alumnos = mysqli_query($conexion, $sentencia);

        // Devolvemos el listado de alumnos, para imprimirlo en el index_controller.
        return $listado_alumnos;

        // Cerrar statement
        // mysqli_stmt_close($stmt);
    }

    public static function getAlumnosEmail() {

        $sentencia = "SELECT ".ALUMNO['email']." FROM ".ALUMNO['tabla'].";";
        $listado_alumnos = mysqli_query($conexion, $sentencia);

        return $correos_alumnos;
    }

    /**
     * 
     */
    public static function createAlumno($conexion, $nombre_alumno, $primer_apellido_alumno, $segundo_apellido_alumno, $email_alumno, $dni_alumno) {

        $alumno = new Alumno (null,$nombre_alumno, $primer_apellido_alumno, $segundo_apellido_alumno, $email_alumno, $dni_alumno);

        // TRANSACCIÓN PARA CREAD ALUMNO Y SUS NOTAS
        mysqli_autocommit($conexion, false);
        try {
            mysqli_begin_transaction($conexion);
        
            $sql1 = "INSERT INTO ".ALUMNO['tabla']." (".ALUMNO['id'].", ".ALUMNO['nombre'].", ".ALUMNO['primer_apellido'].", ".ALUMNO['segundo_apellido'].", ".ALUMNO['email'].", ".ALUMNO['dni'].") VALUES (null, '{$alumno->getNombre()}', '{$alumno->getPrimerApellido()}', '{$alumno->getSegundoApellido()}', '{$alumno->getEmail()}', '{$alumno->getDni()}');";
            mysqli_query($conexion, $sql1);
        
            $alumno_id = mysqli_insert_id($conexion);
        
            foreach (getModulos($conexion) as $modulo) {
                $sql2 = "INSERT INTO tbl_alumno_modulo(id_alumno_modulo, nota_uf1, nota_uf2, nota_uf3, nota_final, id_Alumno, id_Modulo) VALUES(null, null, null, null, null, $alumno_id, {$modulo['id_modulo']});";
                mysqli_query($conexion, $sql2);
            }
        
            mysqli_commit($conexion);
        } catch (\Thorwable $e) {
            mysqli_rollback($conexion);
        }
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