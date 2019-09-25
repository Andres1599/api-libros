<?php
/**
 * contains properties and methods for "category" database queries.
 */

class ModeradorUsuario
{
    //db conn and table
    private $conn;
    private $table_name = "tb_moderador_usuario";

    //object properties
    public $fk_id_moredador;
    public $fk_id_usuario;

    public function __construct($db)
    {
        $this->conn = $db;
    }

}
