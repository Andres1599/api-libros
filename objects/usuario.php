<?php
/**
 * contains properties and methods for "category" database queries.
 */

class Usuario
{
    //db conn and table
    private $conn;
    private $table_name = "tb_usuario";

    //object properties
    public $id_usuario;
    public $correo_usuario;
    public $contrasena_usuario;
    public $estado_usuario;
    public $fk_id_tipo_usuario;

    public function __construct($db)
    {
        $this->conn = $db;
    }

}
