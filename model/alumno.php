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


    public static function getAlumnos($conexion, $filtro_nombre='', $filtro_apellidos='', $filtro_email='', $filtro_dni='', $filtro_limite=5, $pagina=1) {

        // primer registro a mostrar en la pagina
        $primer_registro = ($pagina-1) * $filtro_limite;
        $ultimo_registro = $primer_registro + $filtro_limite-1;

        // sentencia inclusiva de los filtros
        $sentencia = 
        "SELECT * FROM ".ALUMNO['tabla']." 
        WHERE ".ALUMNO['nombre']." LIKE '%".$filtro_nombre."%' 
        AND (".ALUMNO['primer_apellido']." LIKE '%".$filtro_apellidos."%'
        OR ".ALUMNO['segundo_apellido']." LIKE '%".$filtro_apellidos."%')
        AND ".ALUMNO['email']." LIKE '%".$filtro_email."%'
        AND ".ALUMNO['dni']." LIKE '%".$filtro_dni."%'
        ;";
        
        $listado_alumnos = mysqli_query($conexion, $sentencia);
        $listado_alumnos_limitada = [];

        $cont = 0;
        foreach ($listado_alumnos as $key => $value) {
            if ($cont >= $primer_registro && $cont <= $ultimo_registro) {
                $listado_alumnos_limitada[$key] = $value;
            }
            $cont++;
        }

        // Devolvemos el listado de alumnos, para imprimirlo en el index_controller.
        return $listado_alumnos_limitada;
    }

    public static function getCantidadAlumnosVisibles($conexion, $filtro_nombre='', $filtro_apellidos='', $filtro_email='', $filtro_dni='')
    {
        // sentencia inclusiva de los filtros
        $sentencia = 
        "SELECT COUNT(1) AS total FROM ".ALUMNO['tabla']." 
        WHERE ".ALUMNO['nombre']." LIKE '%".$filtro_nombre."%' 
        AND (".ALUMNO['primer_apellido']." LIKE '%".$filtro_apellidos."%'
        OR ".ALUMNO['segundo_apellido']." LIKE '%".$filtro_apellidos."%')
        AND ".ALUMNO['email']." LIKE '%".$filtro_email."%'
        AND ".ALUMNO['dni']." LIKE '%".$filtro_dni."%'
        ;";
        
        $listado_alumnos = mysqli_fetch_assoc(mysqli_query($conexion, $sentencia))['total'];

        // Devolvemos el listado de alumnos, para imprimirlo en el index_controller.
        return $listado_alumnos;
    }

    public static function getTotalAlumnos($conexion)
    {
        $sentencia =
        "SELECT COUNT(1) as total FROM ".ALUMNO['tabla'].";";
        
        return mysqli_fetch_assoc(mysqli_query($conexion, $sentencia))['total'];
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
    
    public static function checkDNI($conexion, $dni_alumno) {
        $sql = "SELECT * FROM ".ALUMNO['tabla']." WHERE ".ALUMNO['dni']." = '$dni_alumno';";

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

    // public static function getAlumnosEmail() {

    //     $sentencia = "SELECT ".ALUMNO['email']." FROM ".ALUMNO['tabla'].";";
    //     $listado_alumnos = mysqli_query($conexion, $sentencia);
    //     return $correos_alumnos;
    // }

    public static function errorEmail($email_alumno){
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

        // TRANSACCIÓN PARA CREAR ALUMNO Y SUS NOTAS
        mysqli_autocommit($conexion, false);
        try {
            mysqli_begin_transaction($conexion);
        
            $sql1 = "INSERT INTO ".ALUMNO['tabla']." (".ALUMNO['id'].", ".ALUMNO['nombre'].", ".ALUMNO['primer_apellido'].", ".ALUMNO['segundo_apellido'].", ".ALUMNO['email'].", ".ALUMNO['dni'].") VALUES (null, '{$alumno->getNombre()}', '{$alumno->getPrimerApellido()}', '{$alumno->getSegundoApellido()}', '{$alumno->getEmail()}', '{$alumno->getDni()}');";
            mysqli_query($conexion, $sql1);
        
            $alumno_id = mysqli_insert_id($conexion);
        
            foreach (self::getModulos($conexion) as $modulo) {
                $sql2 = "INSERT INTO ".ALUMNO_MODULO['tabla']."(".ALUMNO_MODULO['id'].", ".ALUMNO_MODULO['nota_uf1'].", ".ALUMNO_MODULO['nota_uf2'].", ".ALUMNO_MODULO['nota_uf3'].", ".ALUMNO_MODULO['nota_final'].", ".ALUMNO_MODULO['id_alumno'].", ".ALUMNO_MODULO['id_modulo'].") VALUES(null, null, null, null, null, $alumno_id, {$modulo['id_modulo']});";
                mysqli_query($conexion, $sql2);
            }
        
            mysqli_commit($conexion);
        } catch (\Throwable $e) {
            mysqli_rollback($conexion);
        }
    }

    // Funciones para recoger información específica del alumno, tanto datos como notas
    public static function getAlumnoId($id_alumno, $conexion) {
        $sql = "SELECT * FROM ".ALUMNO['tabla']." WHERE ".ALUMNO['id']. " = '$id_alumno';";
        return mysqli_fetch_assoc(mysqli_query($conexion, $sql));

        // TRANSACCIÓN PARA BORRAR ALUMNO Y SUS NOTAS
        mysqli_autocommit($conexion, false);
        try {
            mysqli_begin_transaction($conexion);
        
            foreach (self::getModulos($conexion) as $modulo) {
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
    public static function getNotasAlumno($id_alumno, $conexion) {
        $sql = "SELECT * FROM ".ALUMNO_MODULO['tabla']." WHERE ".ALUMNO_MODULO['id_alumno']. " = '$id_alumno';";
        return mysqli_fetch_all(mysqli_query($conexion, $sql));
    }

    /**
     * 
     */
    public static function deleteAlumno($id_alumno, $conexion) {

        // TRANSACCIÓN PARA BORRAR ALUMNO Y SUS NOTAS
        mysqli_autocommit($conexion, false);
        try {
            mysqli_begin_transaction($conexion);
            
            foreach (self::getModulos($conexion) as $modulo) {
                $sql2 = "DELETE FROM ".ALUMNO_MODULO['tabla']." WHERE ".ALUMNO_MODULO['id_alumno']." = $id_alumno;";
                mysqli_query($conexion, $sql2);
            }
        
            $sql1 = "DELETE FROM ".ALUMNO['tabla']." WHERE ".ALUMNO['id']." = $id_alumno;";
            mysqli_query($conexion, $sql1);
        
            $alumno_id = mysqli_insert_id($conexion);
        
            return mysqli_commit($conexion);
        } catch (\Throwable $e) {
            mysqli_rollback($conexion);

            return false;
        }

    }

    /**
     * 
     */
    public static function updateAlumno($id_alumno, $nombre_alumno, $primer_apellido_alumno, $segundo_apellido_alumno, $email_alumno, $dni_alumno, $conexion) {

        $sql = 
        "UPDATE ".ALUMNO['tabla']." 
        SET ".ALUMNO['nombre']." = '$nombre_alumno', 
        ".ALUMNO['primer_apellido']." = '$primer_apellido_alumno', 
        ".ALUMNO['segundo_apellido']." = '$segundo_apellido_alumno', 
        ".ALUMNO['email']." = '$email_alumno', 
        ".ALUMNO['dni']." = '$dni_alumno' 
        WHERE ".ALUMNO['id']." = $id_alumno
        ";

        // Ejecutamos consulta para actualizar el usuario
        return mysqli_query($conexion, $sql);
    }

    
    /**
     * 
     */
    public static function getMejoresAlumnosModulo($conexion, $id_modulo, $limite=3)
    {
        $sql = 
        "SELECT ".ALUMNO['tabla'].".*, ".ALUMNO_MODULO['tabla'].".*
        FROM ".ALUMNO['tabla']." INNER JOIN ".ALUMNO_MODULO['tabla']." 
        ON ".ALUMNO['tabla'].".".ALUMNO['id']." = ".ALUMNO_MODULO['tabla'].".".ALUMNO_MODULO['id_alumno']."
        WHERE ".ALUMNO_MODULO['tabla'].".".ALUMNO_MODULO['id_modulo']." = $id_modulo
        ORDER BY ".ALUMNO_MODULO['nota_final']." DESC
        LIMIT $limite;";

        return mysqli_query($conexion, $sql);
    }

    /**
     * 
     */
    public static function getNotaMediaModulo($conexion, $id_modulo)
    {
        $sql = 
        "SELECT AVG(".ALUMNO_MODULO['nota_final'].") AS media 
        FROM ".ALUMNO_MODULO['tabla']."
        WHERE ".ALUMNO_MODULO['id_modulo']." = $id_modulo;";

        return mysqli_fetch_assoc(mysqli_query($conexion, $sql))['media'];
    }

    /**
     * 
     */
    public static function getModulos($conexion)
    {
        $stmt = "SELECT * FROM ".MODULO['tabla'].";";

        // $modulos = mysqli_fetch_assoc(mysqli_query($conexion, $stmt));
        $modulos = mysqli_query($conexion, $stmt);

        return $modulos;
    }

    /**
     * 
     */
    public static function getEmailAlumnosDeModulo($modulo, $conexion)
    {
        $lista_alumnos = [];

        $stmt = "SELECT ".ALUMNO['email']." FROM ".ALUMNO['tabla']." INNER JOIN ".ALUMNO_MODULO['tabla']." ON ".ALUMNO['tabla'].".".ALUMNO['id']." = ".ALUMNO_MODULO['tabla'].".".ALUMNO_MODULO['id_alumno']." WHERE ".ALUMNO_MODULO['tabla'].".".ALUMNO_MODULO['id_modulo']." = $modulo;";

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
    public static function updateNotas($notasGlobal, $id_alumno, $conexion) {
        // var_dump($notasGlobal['m1']);
        for ($i=1; $i <= count($notasGlobal); $i++) { 
            $sql = "UPDATE ".ALUMNO_MODULO['tabla']." SET ".ALUMNO_MODULO['nota_uf1']." = ".$notasGlobal["m$i"]['uf1'].", ".ALUMNO_MODULO['nota_uf2']." = ".$notasGlobal["m$i"]['uf2'].", ".ALUMNO_MODULO['nota_uf3']." = ".$notasGlobal["m$i"]['uf3'].", ".ALUMNO_MODULO['nota_final']." = ".$notasGlobal["m$i"]['media']." WHERE ".ALUMNO_MODULO['id_alumno']." = ".$id_alumno." AND ".ALUMNO_MODULO['id_modulo']." = ".$i.";";
            // Ejecutamos consulta para actualizar el usuario
            mysqli_query($conexion, $sql);
        }
    }

}