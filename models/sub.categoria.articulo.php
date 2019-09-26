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

    //crear una o varias categorias para los articulos
    public function createCategoria() {
        //prepare query
        $query = "INSERT INTO ".$this->table_name." VALUES (:fk,:sub);";
        //prepare 
        $stmt = $this->conn->prepare($query);
        //sanitize
        $this->fk_id_articulo=htmlspecialchars(strip_tags($this->fk_id_articulo));
        $this->fk_id_sub_categoria=htmlspecialchars(strip_tags($this->fk_id_sub_categoria));
        //bind
        $stmt->bindParam(":fk", $this->fk_id_articulo);
        $stmt->bindParam(":sub", $this->fk_id_sub_categoria);
        //execute
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    
    //elimina una categoria del articulo
    public function deleteCategoria() {
        //prepare query
        $query = "DELETE FROM ".$this->table_name." WHERE fk_id_articulo= ? AND fk_id_sub_categoria= ?;";
        //prepare 
        $stmt = $this->conn->prepare($query);
        //sanitize
        $this->fk_id_articulo=htmlspecialchars(strip_tags($this->fk_id_articulo));
        $this->fk_id_sub_categoria=htmlspecialchars(strip_tags($this->fk_id_sub_categoria));
        //bind
        $stmt->bindParam(1, $this->fk_id_articulo);
        $stmt->bindParam(2, $this->fk_id_sub_categoria);
        //execute
        if($stmt->execute()){
            return true;
        }
        return false;
    }

}
