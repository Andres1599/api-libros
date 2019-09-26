<?php

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

    //crea un articulo
    public function createA() {
        $query = "INSERT INTO ".$this->table_name." (titulo_articulo,cuerpo_articulo,fecha_creacion,fecha_publicacion,estado_articulo) 
                    VALUES (:titulo,:cuerpo,NOW(),NULL,false);";
        //prepare
        $stmt = $this->conn->prepare($query);
        //sanitize
        $this->titulo_articulo=htmlspecialchars(strip_tags($this->titulo_articulo));
        $this->cuerpo_articulo=htmlspecialchars(strip_tags($this->cuerpo_articulo));
        //bind foreign key and the path
        $stmt->bindParam(":titulo", $this->titulo_articulo);
        $stmt->bindParam(":cuerpo", $this->cuerpo_articulo);
        //execute
        if($stmt->execute()){
            return true;
        }
        return false;
    }

}
