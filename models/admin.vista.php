<?php
/**
 * contains properties and methods for "category" database queries.
 */

class AdminVista
{
    //db conn and table
    private $conn;
    private $table_name = "tb_admin_vista";

    //object properties
    public $id_vista;
    public $plantilla;
    public $fk_id_usuario;
    public $fecha_cambio;
    
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // obtiene el ultimo cambio de la plantilla
    public function getLast(){
        //select all
        $query = "SELECT * FROM tb_admin_vista ORDER BY fecha_cambio DESC LIMIT 1;";
        //prepare
        $stmt = $this->conn->prepare($query);
        //execute
        $stmt->execute();
        return $stmt;
    }

    // cambia la plantilla
    public function changePlantilla(){
        //select all
        $query = "INSERT INTO tb_admin_vista VALUES (0,:plantilla,:id,NOW())";
        //prepare
        $stmt = $this->conn->prepare($query);
        //sanitize
        $this->plantilla = htmlspecialchars(strip_tags($this->plantilla));
        $this->fk_id_usuario = htmlspecialchars(strip_tags($this->fk_id_usuario));
        //bind
        $stmt->bindParam(":plantilla",$this->plantilla);
        $stmt->bindParam(":id",$this->fk_id_usuario);
        //execute
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // obtener las ultimas 5
    public function get(){
        //select all
        $query = "SELECT * FROM tb_admin_vista ORDER BY fecha_cambio DESC LIMIT 5;";
        //prepare
        $stmt = $this->conn->prepare($query);
        //execute
        $stmt->execute();
        return $stmt;
    }
}
