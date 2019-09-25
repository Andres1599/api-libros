<?php
/**
 * contains properties and methods for "category" database queries.
 */

class SubCategorias
{
    //db conn and table
    private $conn;
    private $table_name = "tb_sub_categorias";

    //object properties
    public $id_sub_categoria;
    public $nombre_sub_categoria;
    public $fk_id_categoria;
    

    public function __construct($db)
    {
        $this->conn = $db;
    }

}
