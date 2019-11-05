<?php
/**
 * contains properties and methods for "category" database queries.
 */

class Subscripcion
{
    //db conn and table
    private $conn;
    private $table_name = "tb_subscripcion";

    //object properties
    public $id_subscripcion;
    public $fk_id_usuario;
    public $estado_subscripcion;
    public $fecha_activacion;
    public $fecha_expiracion;
    public $id_tipo_sub;
    public $tipo_sub;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getTipoSub(){
        $query = "SELECT * FROM tb_tipo_subscripcion;";
        //prepare
        $stmt = $this->conn->prepare($query);
        //execute
        $stmt->execute();
        // return execute
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // retornar los tipos de subscripción
        return $row;
    }

    public function createTipoSub() {
        $query = "INSERT INTO tb_tipo_subscripcion VALUES (0,?)";
        //prepare
        $stmt = $this->conn->prepare($query);
        //execute
        $this->tipo_sub=htmlspecialchars(strip_tags($this->tipo_sub));
        //bind foreign key and the path
        $stmt->bindParam(1, $this->tipo_sub);
        // return execute
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteTipoSub() {
        $query = "DELETE FROM tb_tipo_subscripcion WHERE id_tipo_sub = ?;";
        //prepare
        $stmt = $this->conn->prepare($query);
        //execute
        $this->id_tipo_sub=htmlspecialchars(strip_tags($this->id_tipo_sub));
        //bind foreign key and the path
        $stmt->bindParam(1, $this->id_tipo_sub);
        // return execute
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateSub(){
        $query = "UPDATE tb_subscripcion SET estado_subscripcion=1,fecha_activacion=NOW(),fecha_expiracion=DATE_ADD(NOW(), INTERVAL 1 YEAR), fk_id_tipo_sub=? WHERE id_subscripcion=?";
        //prepare
        $stmt = $this->conn->prepare($query);
        //execute
        $this->id_tipo_sub=htmlspecialchars(strip_tags($this->id_tipo_sub));
        $this->id_subscripcion=htmlspecialchars(strip_tags($this->id_subscripcion));
        //bind foreign key and the path
        $stmt->bindParam(1, $this->id_tipo_sub);
        $stmt->bindParam(2, $this->id_subscripcion);
        // return execute
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getMySubscripcion() {
        $query = "SELECT * FROM tb_subscripcion s LEFT OUTER JOIN tb_tipo_subscripcion t ON s.fk_id_tipo_sub = t.id_tipo_sub where fk_id_usuario =?;";
        //prepare
        $stmt = $this->conn->prepare($query);
        //sanitize
        $this->fk_id_usuario=htmlspecialchars(strip_tags($this->fk_id_usuario));
        //bind
        $stmt->bindParam(1, $this->fk_id_usuario);
        //execute
        if($stmt->execute()){
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $row[0];
        }else {
            return false;
        }
    }
}
