<?php
/**
 * contains properties and methods for "category" database queries.
 */

class Subscripcion
{
    //db conn and table
    private $conn;
    private $table_name = "tb_subscripcion";

    //object properties
    public $id_subscripcion;
    public $fk_id_usuario;
    public $estado_subscripcion;
    public $fecha_activacion;
    public $fecha_expiracion;
    

    public function __construct($db)
    {
        $this->conn = $db;
    }

}
