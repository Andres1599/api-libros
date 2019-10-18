<?php
/**
 * contains properties and methods for "category" database queries.
 */

class Imagenes
{
    //db conn and table
    private $conn;
    private $table_name = "tb_imagenes";

    //object properties
    public $id_imagen;
    public $imagen;


    public function __construct($db)
    {
        $this->conn = $db;
    }

    //obtener todos los datos de los usuarios
    public function getImagen() {
        //select all
        $query = "SELECT * FROM tb_imagenes limit 1;";
        //prepare
        $stmt = $this->conn->prepare($query);
        //execute
        $stmt->execute();
        return $stmt;
    }

    public function createImagen() {
        //select all
        $query = "INSERT INTO  tb_imagenes VALUES (0,:img);";
        //prepare
        $stmt = $this->conn->prepare($query);
        //sanitize
        $this->imagen=htmlspecialchars(strip_tags($this->imagen));
        //bind
        $stmt->bindParam(":img", $this->imagen);
        //execute
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

}
