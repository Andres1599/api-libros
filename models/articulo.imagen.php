<?php
/**
 * contains properties and methods for "category" database queries.
 */

class ArticuloImagen
{
    //db conn and table
    private $conn;
    private $table_name = "tb_articulo_imagen";

    //object properties
    public $id_articulo_imagen;
    public $fk_id_articulo;
    public $path;

    public function __construct($db)
    {
        $this->conn = $db;
    }

}
