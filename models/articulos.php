<?php
/**
 * contains properties and methods for "category" database queries.
 */

class Articulos
{
    //db conn and table
    private $conn;
    private $table_name = "tb_articulos";

    //object properties
    public $id_articulo;
    public $titulo_articulo;
    public $cuerpo_articulo;
    public $fecha_creacion;
    public $fecha_publicacion;
    public $estado_articulo;

    public function __construct($db)
    {
        $this->conn = $db;
    }

}
