<?php

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

    //asosia una imagen a un articulo
    public function createAI(){
        //prepare query
        $query = "INSERT INTO ". $this->table_name ." (fk_id_articulo,path) VALUES (:fk,:path);";
        //prepare
        $stmt = $this->conn->prepare($query);
        //sanitize
        $this->fk_id_articulo=htmlspecialchars(strip_tags($this->fk_id_articulo));
        $this->path=htmlspecialchars(strip_tags($this->path));
        //bind foreign key and the path
        $stmt->bindParam(":fk", $this->fk_id_articulo);
        $stmt->bindParam(":path", $this->path);
        //execute
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    //elimina una imagen asosiada a un articulo
    public function deleteAI(){
        $query = "DELETE FROM ". $this->table_name ." WHERE id_articulo_imagen = ?;";
        $stmt = $this->conn->prepare($query);
        $this->id_articulo_imagen=htmlspecialchars(strip_tags($this->id_articulo_imagen));
        $stmt->bindParam(1, $this->id_articulo_imagen);
         //execute
         if($stmt->execute()){
            return true;
        }
        return false;
    }

    
}
