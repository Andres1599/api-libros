<?php
/**
 * contains properties and methods for "category" database queries.
 */

class TipoUsuario
{
    //db conn and table
    private $conn;
    private $table_name = "tb_tipo_usuario";

    //object properties
    public $id_tipo_usuario;
    public $tipo_usuario;
    

    public function __construct($db)
    {
        $this->conn = $db;
    }

}
