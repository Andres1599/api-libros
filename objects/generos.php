<?php
/**
 * contains properties and methods for "category" database queries.
 */

class Generos
{
    //db conn and table
    private $conn;
    private $table_name = "tb_generos";

    //object properties
    public $id_genero;
    public $nombre_genero;
    
    public function __construct($db)
    {
        $this->conn = $db;
    }

}
