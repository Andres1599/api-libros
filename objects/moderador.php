<?php
/**
 * contains properties and methods for "category" database queries.
 */

class Moderador
{
    //db conn and table
    private $conn;
    private $table_name = "tb_moderador";

    //object properties
    public $id_moderador;
    public $fk_id_articulo;
    public $fk_id_comentario;
    public $fk_id_subcomentario;   
    public $estado_moderacion;
    public $fk_id_usuario;

    public function __construct($db)
    {
        $this->conn = $db;
    }

}
