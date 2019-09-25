<?php
/**
 * contains properties and methods for "category" database queries.
 */

class SubCategoriaArticulo
{
    //db conn and table
    private $conn;
    private $table_name = "tb_sub_categoria_articulo";

    //object properties
    public $fk_id_articulo;
    public $fk_id_sub_categoria;
    
    public function __construct($db)
    {
        $this->conn = $db;
    }

}
