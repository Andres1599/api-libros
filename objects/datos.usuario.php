<?php
/**
 * contains properties and methods for "category" database queries.
 */

class DatosUsuario
{
    //db conn and table
    private $conn;
    private $table_name = "tb_datos_usuario";

    //object properties
    public $fk_id_usuario;
    public $nombre_usuario;
    public $apellido_usuario;
    public $fk_id_usuario;


    public function __construct($db)
    {
        $this->conn = $db;
    }

}
