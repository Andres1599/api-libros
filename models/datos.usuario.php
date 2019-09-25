<?php
/**
 * contains properties and methods for "category" database queries.
 */

class DatosUsuario
{
    //db conn and table
    private $conn;
    private $table_name = "tb_datos_usuario";

    //object properties
    public $fk_id_usuario;
    public $nombre_usuario;
    public $apellido_usuario;
    public $fk_id_genero;


    public function __construct($db)
    {
        $this->conn = $db;
    }

    //total de datos por usuario
    public function count(){
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total_rows'];
    }

    //obtener todos los datos de los usuarios
    public function read(){
        //select all
        $query = "SELECT fk_id_usuario,nombre_usuario,apellido_usuario,fk_id_genero FROM " . $this->table_name . "";
        //prepare
        $stmt = $this->conn->prepare($query);
        //execute
        $stmt->execute();
        return $stmt;
    }

}
