<?php
/**
 * contains properties and methods for "category" database queries.
 */

class Comentario
{
    //db conn and table
    private $conn;
    private $table_name = "tb_comentario";

    //object properties
    public $id_comentario;
    public $cuerpo_comentario;
    public $fecha_publicacion;
    public $estado_comentario;
    public $fk_id_articulo;
    public $reporte_comentario;
    public $fk_id_padre;
    public $fk_id_usuario;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getComentarios() {
        $query = "SELECT * FROM tb_comentario WHERE fk_id_articulo=? AND fk_id_padre IS NULL AND estado_comentario = 1;";
        //prepare
        $stmt = $this->conn->prepare($query);
        //sanitize
        $this->fk_id_articulo = htmlspecialchars(strip_tags($this->fk_id_articulo));
        //bind
        $stmt->bindParam(1,$this->fk_id_articulo);
        //execute
        if ($stmt->execute()) {
            return $stmt;
        } else {
            return false;
        }
    }

    public function createComentario() {
        $query = "INSERT INTO tb_comentario VALUES(0,?,NOW(),0,?,0,NULL,?);";
        //prepare
        $stmt = $this->conn->prepare($query);
        //sanitize
        $this->cuerpo_comentario = htmlspecialchars(strip_tags($this->cuerpo_comentario));
        $this->fk_id_articulo = htmlspecialchars(strip_tags($this->fk_id_articulo));
        $this->fk_id_usuario = htmlspecialchars(strip_tags($this->fk_id_usuario));
        //bind
        $stmt->bindParam(1,$this->cuerpo_comentario);
        $stmt->bindParam(2,$this->fk_id_articulo);
        $stmt->bindParam(3,$this->fk_id_usuario);
        //execute
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function createComentarioHijo() {
        $query = "INSERT INTO tb_comentario VALUES(0,?,NOW(),0,?,0,?,?);";
        //prepare
        $stmt = $this->conn->prepare($query);
        //sanitize
        $this->cuerpo_comentario = htmlspecialchars(strip_tags($this->cuerpo_comentario));
        $this->fk_id_articulo = htmlspecialchars(strip_tags($this->fk_id_articulo));
        $this->fk_id_padre = htmlspecialchars(strip_tags($this->fk_id_padre));
        $this->fk_id_usuario = htmlspecialchars(strip_tags($this->fk_id_usuario));
        //bind
        $stmt->bindParam(1,$this->cuerpo_comentario);
        $stmt->bindParam(2,$this->fk_id_articulo);
        $stmt->bindParam(3,$this->fk_id_padre);
        $stmt->bindParam(4,$this->fk_id_usuario);
        //execute
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getSubComentarios(){
        $query = "SELECT * FROM tb_comentario WHERE fk_id_padre=? AND estado_comentario = 1;";
        //prepare
        $stmt = $this->conn->prepare($query);
        //sanitize
        $this->fk_id_padre = htmlspecialchars(strip_tags($this->fk_id_padre));
        //bind
        $stmt->bindParam(1,$this->fk_id_padre);
        //execute
        if ($stmt->execute()) {
            return $stmt;
        } else {
            return false;
        }
    }

    public function reportar(){
        $query = "UPDATE tb_comentario SET reporte_comentario = reporte_comentario + 1 WHERE id_comentario=?;";
        //prepare
        $stmt = $this->conn->prepare($query);
        //sanitize
        $this->id_comentario = htmlspecialchars(strip_tags($this->id_comentario));
        //bind
        $stmt->bindParam(1,$this->id_comentario);
        //execute
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

}
