<?php
/**
 * contains properties and methods for "category" database queries.
 */

class Publicidad
{
    //db conn and table
    private $conn;
    private $table_name = "tb_publicidad";

    //object properties
    public $id_publicidad;
    public $nombre_publicidad;
    public $imagen_publicidad;
    public $vista;
   
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createPublicidad() {
        $query = "INSERT INTO tb_publicidad VALUES(0,?,?,0)";
        //prepare
        $stmt = $this->conn->prepare($query);
        //sanitize
        $this->nombre_publicidad=htmlspecialchars(strip_tags($this->nombre_publicidad));
        $this->imagen_publicidad=htmlspecialchars(strip_tags($this->imagen_publicidad));
        //bind id
        $stmt->bindParam(1,$this->nombre_publicidad);
        $stmt->bindParam(2,$this->imagen_publicidad);
        //execute
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function deletePublicidad(){
        $query = "DELETE FROM tb_publicidad WHERE id_publicidad=?;";
        //prepare
        $stmt = $this->conn->prepare($query);
        //sanitize
        $this->id_publicidad=htmlspecialchars(strip_tags($this->id_publicidad));
        //bind id
        $stmt->bindParam(1,$this->id_publicidad);
        //execute
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function getAll(){
        $query = "SELECT * FROM tb_publicidad;";
        //prepare
        $stmt = $this->conn->prepare($query);
        //execute
        if($stmt->execute()){
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        } else {
            return false;
        }
    }

    public function editPublicidad() {
        $query = "UPDATE tb_publicidad SET nombre_publicidad=?, imagen_publicidad=? WHERE id_publicidad=?;";
        //prepare
        $stmt = $this->conn->prepare($query);
        //sanitize
        $this->nombre_publicidad=htmlspecialchars(strip_tags($this->nombre_publicidad));
        $this->imagen_publicidad=htmlspecialchars(strip_tags($this->imagen_publicidad));
        $this->id_publicidad=htmlspecialchars(strip_tags($this->id_publicidad));
        //bind id
        $stmt->bindParam(1,$this->nombre_publicidad);
        $stmt->bindParam(2,$this->imagen_publicidad);
        $stmt->bindParam(3,$this->id_publicidad);
        //execute
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function updateVista(){
        $query = "UPDATE tb_publicidad SET vista = vista + 1 WHERE id_publicidad=?;";
        //prepare
        $stmt = $this->conn->prepare($query);
        //sanitize
        $this->id_publicidad=htmlspecialchars(strip_tags($this->id_publicidad));
        //bind id
        $stmt->bindParam(1,$this->id_publicidad);
        //execute
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

}
