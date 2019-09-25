<?php
/**
 * contains properties and methods for "category" database queries.
 */

class SubComentario
{
    //db conn and table
    private $conn;
    private $table_name = "tb_sub_comentario";

    //object properties
    public $id_sub_comentario;
    public $cuerpo_subcomentario;
    public $fecha_creacion;
    public $fecha_publicacion;
    public $estado_subcomentario;
    public $fk_id_usuario;

    public function __construct($db)
    {
        $this->conn = $db;
    }

}
