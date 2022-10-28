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
    }

    public static function checkUser($conexion, $email_alumno) {
        $sql = "SELECT * FROM ".ALUMNO['tabla']." WHERE ".ALUMNO['email']." = '$email_alumno';";
        
        $id_usuarioExiste = mysqli_fetch_assoc(mysqli_query($conexion, $sql));
        $usuarioExiste = mysqli_query($conexion, $sql);
        // var_dump($usuarioExiste -> num_rows);

        if($row = $usuarioExiste -> num_rows){
            $error = true;
        }else{
            $error = false;
        }
        return $error;
    }
    
    public static function getAlumnosEmail() {

        $sentencia = "SELECT ".ALUMNO['email']." FROM ".ALUMNO['tabla'].";";
        $listado_alumnos = mysqli_query($conexion, $sentencia);

        return $correos_alumnos;
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
                $sql2 = "INSERT INTO ".ALUMNO_MODULO['tabla']."(".ALUMNO_MODULO['id'].", ".ALUMNO_MODULO['nota_uf1'].", ".ALUMNO_MODULO['nota_uf2'].", ".ALUMNO_MODULO['nota_uf3'].", ".ALUMNO_MODULO['nota_final'].", ".ALUMNO_MODULO['id_alumno'].", ".ALUMNO_MODULO['id_modulo'].") VALUES(null, null, null, null, null, $alumno_id, {$modulo['id_modulo']});";
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
    public static function getAlumnoId($id_alumno, $conexion) {

        $sql = "SELECT * FROM ".ALUMNO['tabla']." WHERE ".ALUMNO['id']. " = '$id_alumno';";
        return mysqli_fetch_assoc(mysqli_query($conexion, $sql));

        // TRANSACCIÓN PARA BORRAR ALUMNO Y SUS NOTAS
        mysqli_autocommit($conexion, false);
        try {
            mysqli_begin_transaction($conexion);
        
            foreach (getModulos($conexion) as $modulo) {
                $sql2 = "INSERT INTO tbl_alumno_modulo(id_alumno_modulo, nota_uf1, nota_uf2, nota_uf3, nota_final, id_Alumno, id_Modulo) VALUES(null, null, null, null, null, $alumno_id, {$modulo['id_modulo']});";
                mysqli_query($conexion, $sql2);
            }
        
            $sql1 = "INSERT INTO ".ALUMNO['tabla']." (".ALUMNO['id'].", ".ALUMNO['nombre'].", ".ALUMNO['primer_apellido'].", ".ALUMNO['segundo_apellido'].", ".ALUMNO['email'].", ".ALUMNO['dni'].") VALUES (null, '{$alumno->getNombre()}', '{$alumno->getPrimerApellido()}', '{$alumno->getSegundoApellido()}', '{$alumno->getEmail()}', '{$alumno->getDni()}');";
            mysqli_query($conexion, $sql1);
        
            mysqli_commit($conexion);
        } catch (\Thorwable $e) {
            mysqli_rollback($conexion);
        }
    }

    /**
     * 
     */
    public static function deleteAlumno($id_alumno, $conexion) {

        // TRANSACCIÓN PARA CREAD ALUMNO Y SUS NOTAS
        mysqli_autocommit($conexion, false);
        try {
            mysqli_begin_transaction($conexion);
            
            foreach (getModulos($conexion) as $modulo) {
                $sql2 = "DELETE FROM ".ALUMNO_MODULO['tabla']." WHERE ".ALUMNO_MODULO['id_alumno']." = $id_alumno;";
                mysqli_query($conexion, $sql2);
            }
        
            $sql1 = "DELETE FROM ".ALUMNO['tabla']." WHERE ".ALUMNO['id']." = $id_alumno;";
            mysqli_query($conexion, $sql1);
        
            $alumno_id = mysqli_insert_id($conexion);
        
            return mysqli_commit($conexion);
        } catch (\Thorwable $e) {
            mysqli_rollback($conexion);

            return false;
        }

    }

    /**
     * 
     */
    public static function updateAlumno($id_alumno, $nombre_alumno, $primer_apellido_alumno, $segundo_apellido_alumno, $email_alumno, $dni_alumno, $conexion) {

        $sql = "UPDATE ".ALUMNO['tabla']." SET ".ALUMNO['nombre']." = '$nombre_alumno', ".ALUMNO['primer_apellido']." = '$primer_apellido_alumno', ".ALUMNO['segundo_apellido']." = '$segundo_apellido_alumno', ".ALUMNO['email']." = '$email_alumno', ".ALUMNO['dni']." = '$dni_alumno' WHERE id_alumno = $id_alumno";

        // Ejecutamos consulta para actualizar el usuario
        return mysqli_query($conexion, $sql);
    }

}