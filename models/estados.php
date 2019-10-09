<?php
/**
 * contains properties and methods for "category" database queries.
 */

class Estados
{
    //db conn and table
    private $conn;
    private $table_name = "tb_estados";

    //object properties
    public $id_estado;
    public $nombre_estado;


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
        $query = "SELECT * FROM " . $this->table_name . ";";
        //prepare
        $stmt = $this->conn->prepare($query);
        //execute
        $stmt->execute();
        return $stmt;
    }

}
