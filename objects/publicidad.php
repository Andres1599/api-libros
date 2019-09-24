<?php
/**
 * contains properties and methods for "category" database queries.
 */

class Publicidad
{
    //db conn and table
    private $conn;
    private $table_name = "tb_publicidad";

    //object properties
    public $id_publicidad;
    public $nombre_publicidad;
    public $imagen_publicidad;
   
    public function __construct($db)
    {
        $this->conn = $db;
    }

}
