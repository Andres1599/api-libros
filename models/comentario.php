<?php
/**
 * contains properties and methods for "category" database queries.
 */

class Comentario
{
    //db conn and table
    private $conn;
    private $table_name = "tb_comentario";

    //object properties
    public $id_comentario;
    public $cuerpo_comentario;
    public $fecha_creacion;
    public $fecha_publicacion;
    public $estado_comentario;
    public $fk_id_articulo;

    public function __construct($db)
    {
        $this->conn = $db;
    }

}
