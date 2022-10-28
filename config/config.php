<?php

// Constantes base de datos
const BD = [
    'servidor' => 'localhost',
    'usuario' => 'root',
    'password' => '',
    'bd' => 'bd_gestion_notas',
];

// Constantes tbl_gestor_de_notes
const GESTOR = [
    'tabla' => 'tbl_gestor',
    'id' => 'id_gestor',
    'nombre' => 'nombre_gestor',
    'primer_apellido' => 'primer_apellido_gestor',
    'segundo_apellido' => 'segundo_apellido_gestor',
    'email' => 'email_gestor',
    'contra' => 'contra_gestor',
];

// Constantes tbl_alumno
const ALUMNO = [
    'tabla' => 'tbl_alumno',
    'id' => 'id_alumno',
    'nombre' => 'nombre_alumno',
    'primer_apellido' => 'primer_apellido_alumno',
    'segundo_apellido' => 'segundo_apellido_alumno',
    'email' => 'email_alumno',
    'dni' => 'dni_alumno',
];

// Constantes tbl_módulo
const MODULO = [
    'tabla' => 'tbl_modulo',
    'id' => 'id_modulo',
    'numero' => 'numero_modulo',
    'nombre' => 'nombre_modulo',
];


// TABLAS INTERMEDIAS //
const ALUMNO_MODULO = [
    'tabla' => 'tbl_alumno_modulo',
    'id' => 'id_alumno_modulo',
    'nota_uf1' => 'nota_uf1',
    'nota_uf2' => 'nota_uf2',
    'nota_uf3' => 'nota_uf3',
    'nota_final' => 'nota_final',
    // FK
    'id_alumno' => 'id_Alumno',
    'id_modulo' => 'id_Modulo',
];

const GESTOR_MODULO = [
    'tabla' => 'tbl_gestor_modulo',
    'id' => 'id_gestor_modulo',
    'id_gestor' => 'id_Gestor',
    'id_modulo' => 'id_Modulo',
];
