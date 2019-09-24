<?php
/**
 * contains properties and methods for "category" database queries.
 */

class Usuario
{
    //db conn and table
    private $conn;
    private $table_name = "tb_usuario";
    //object properties
    public $id_usuario;
    public $correo_usuario;
    public $contrasena_usuario;
    public $estado_usuario;
    public $fk_id_tipo_usuario;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    //total de usuarios
    public function count(){
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total_rows'];

    }

    //obtener a los usuarios
    public function read(){
        //select all
        $query = "SELECT id_usuario,correo_usuario,contrasena_usuario,estado_usuario FROM " . $this->table_name . "";
        //prepare
        $stmt = $this->conn->prepare($query);
        //execute
        $stmt->execute();
        return $stmt;
    }

    //eliminar los usuarios
    public function delete(){
        //delete query
        $query = " DELETE FROM " . $this->table_name . " WHERE id_usuario = ?";
        //prepare
        $stmt = $this->conn->prepare($query);
        //sanitize
        $this->id_usuario=htmlspecialchars(strip_tags($this->id_usuario));
        //bind id
        $stmt->bindParam(1, $this->id_usuario);
        //execute
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
