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
    public $_nombre;
    public $_apellido;
    public $_genero;
    public $_tipo;

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
        $query = " DELETE FROM " . $this->table_name . " WHERE id_usuario = ? ;";
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

    //regustrar un nuevo usuario
    public function registro(){
        //out el query con la variable out
        $query = "SET @ID = 0;";
        //preparo el query con la variable out
        $stmt = $this->conn->prepare($query);
        //lo ejecuto
        if ($stmt->execute()){
            //preparo el query con el procedimiento almacenado
            $query = "CALL pr_registro_usuario(:correo,:pass,:tipo,:nombre,:apellido,:genero,@ID);";
            //prepare
            $stmt = $this->conn->prepare($query);
            //sanitize
            $this->_nombre=htmlspecialchars(strip_tags($this->_nombre));
            $this->_apellido=htmlspecialchars(strip_tags($this->_apellido));
            $this->_genero=htmlspecialchars(strip_tags($this->_genero));
            $this->correo_usuario=htmlspecialchars(strip_tags($this->correo_usuario));
            $this->contrasena_usuario=htmlspecialchars(strip_tags($this->contrasena_usuario));
            $this->_tipo=htmlspecialchars(strip_tags($this->_tipo));
            //bind id
            $stmt->bindParam(":nombre",$this->_nombre);
            $stmt->bindParam(":apellido",$this->_apellido);
            $stmt->bindParam(":genero",$this->_genero);
            $stmt->bindParam(":correo",$this->correo_usuario);
            $stmt->bindParam(":pass",$this->contrasena_usuario);
            $stmt->bindParam(":tipo",$this->_tipo);
            //execute
            if ($stmt->execute()){
                //creo el query para obtener el valor
                $_query = "SELECT @ID AS id_usuario";
                //preparo el query para obtener el valor
                $_stmt = $this->conn->prepare($_query);
                //ejecuto el query
                $_stmt->execute();
                //devuelvo el query
                return $_stmt;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    //obtener informacion por id
    public function getUsuarioId(){
        //prepare query
        $query = "SELECT u.id_usuario as id_usuario, u.correo_usuario as correo, u.estado_usuario as estado, d.nombre_usuario as nombre, d.apellido_usuario as apellido, g.nombre_genero as genero FROM tb_usuario u
        LEFT OUTER JOIN tb_datos_usuario d ON u.id_usuario = d.fk_id_usuario
        LEFT OUTER JOIN tb_generos g ON d.fk_id_genero = g.id_genero
        WHERE u.correo_usuario = ?";
        //preparete query
        $stmt = $this->conn->prepare($query);
        //sanitize
        $this->correo_usuario=htmlspecialchars(strip_tags($this->correo_usuario));
        //bind id 
        $stmt->bindParam(1,$this->correo_usuario);
        //execute
        $stmt->execute();
        //fetch
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        //set values
        $this->correo_usuario = $row['correo'];
        $this->estado_usuario = $row['estado'];
        $this->_nombre = $row['nombre'];
        $this->_apellido = $row['apellido'];
        $this->_genero = $row['genero'];
        $this->id_usuario = $row['id_usuario'];
    }

    //hacer login 
    public function log(){
        $query = "SELECT login_usuario(:correo,:pass) AS log";
        //prepare
        $stmt = $this->conn->prepare($query);
        //sanitize
        $this->correo_usuario=htmlspecialchars(strip_tags($this->correo_usuario));
        $this->contrasena_usuario=htmlspecialchars(strip_tags($this->contrasena_usuario));
        //bind id
        $stmt->bindParam(":correo",$this->correo_usuario);
        $stmt->bindParam(":pass",$this->contrasena_usuario);
        //execute
        $stmt->execute();
        return $stmt;
    }

}
