<?php
/**
 * contains properties and methods for "category" database queries.
 */

class SubCategorias
{
    //db conn and table
    private $conn;
    private $table_name = "tb_sub_categorias";
    private $table_name_ = "tb_categorias";
    //object properties
    public $id_sub_categoria;
    public $nombre_sub_categoria;
    public $fk_id_categoria;
    public $id_categoria;
    public $nombre_categoria;
    public $estado_categoria;
    

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createSubCategoria(){
        //preara query
        $query = "INSERT INTO ".$this->table_name."VALUES (:nombre,:categoria);";
        //prepare
        $stmt = $this->conn->prepare($query);
        //sanitize
        $this->nombre_sub_categoria = htmlspecialchars(strip_tags($this->nombre_sub_categoria));
        $this->fk_id_categoria = htmlspecialchars(strip_tags($this->fk_id_categoria));
        //bind
        $stmt->bindParam(":nombre",$this->nombre_sub_categoria);
        $stmt->bindParam(":categoria",$this->fk_id_categoria);
        //execute
        if ($stmt->execute()) {
            return true;
        } 
        return false;
    } 

    public function createCategoria(){
        $query = "INSERT INTO ".$this->table_name_."VALUES (:nombre,true);";
        //prepare
        $stmt = $this->conn->prepare($query);
        //sanitize
        $this->nombre_sub_categoria = htmlspecialchars(strip_tags($this->nombre_sub_categoria));
        $this->fk_id_categoria = htmlspecialchars(strip_tags($this->fk_id_categoria));
        //bind
        $stmt->bindParam(":nombre",$this->nombre_sub_categoria);
        //execute
        if ($stmt->execute()) {
            return true;
        } 
        return false;
    }

    public function getAllCategorias(){
        $query = "SELECT c.id_categoria as id_categoria,c.nombre_categoria as nombre_categoria,c.estado_categoria as estado_categoria, sc.id_sub_categoria as id_sub_categoria,sc.nombre_sub_categoria as nombre_sub_categoria FROM tb_categorias c 
        LEFT OUTER JOIN tb_sub_categorias sc ON c.id_categoria = sc.fk_id_categoria;";
        //prepare
        $stmt = $this->conn->prepare($query);
        //execute
        $stmt->execute();
        return $stmt;
    }

    public function getCategorias(){
        $query = "SELECT id_categoria,nombre_categoria,estado_categoria FROM tb_categorias;";
        //prepare
        $stmt = $this->conn->prepare($query);
        //execute
        $stmt->execute();
        return $stmt;
    }

    public function getSubCategoria(){
        $query = "SELECT * FROM tb_sub_categorias";
        //prepare
        $stmt = $this->conn->prepare($query);
        //execute
        $stmt->execute();
        return $stmt;
    }

    public function deleteSubCat() {
        $query = "DELETE FROM tb_sub_categorias WHERE id_sub_categoria = ?;";
        //prepare
        $stmt = $this->conn->prepare($query);
        //sanitize
        $this->id_sub_categoria = htmlspecialchars(strip_tags($this->id_sub_categoria));
        //bind
        $stmt->bindParam(1,$this->id_sub_categoria);
        //execute
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        
    }

    public function deleteCat() {
        $query = "DELETE FROM tb_categorias WHERE id_categoria = ?;";
        //prepare
        $stmt = $this->conn->prepare($query);
        //sanitize
        $this->id_categoria = htmlspecialchars(strip_tags($this->id_categoria));
        //bind
        $stmt->bindParam(1,$this->id_categoria);
        //execute
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

}
