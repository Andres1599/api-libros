<?php
/**
 * contains properties and methods for "category" database queries.
 */

class TipoUsuario
{
    //db conn and table
    private $conn;
    private $table_name = "tb_tipo_usuario";

    //object properties
    public $id_tipo_usuario;
    public $tipo_usuario;
    

    public function __construct($db)
    {
        $this->conn = $db;
    }

    //total de tipos de usuario
    public function count(){
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total_rows'];
    }

    //obtener todos los tipos de usuarios
    public function read(){
        //select all
        $query = "SELECT id_tipo_usuario,tipo_usuario FROM " . $this->table_name . "";
        //prepare
        $stmt = $this->conn->prepare($query);
        //execute
        $stmt->execute();
        return $stmt;
    }

    //eliminar los tipos de usuario por el id
    public function delete(){
        //delete query
        $query = " DELETE FROM " . $this->table_name . " WHERE id_tipo_usuario = ?";
        //prepare
        $stmt = $this->conn->prepare($query);
        //sanitize
        $this->id_tipo_usuario=htmlspecialchars(strip_tags($this->id_tipo_usuario));
        //bind id
        $stmt->bindParam(1, $this->id_tipo_usuario);
        //execute
        if($stmt->execute()){
            return true;
        }
        return false;
    }

}
