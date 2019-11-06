<?php

class ArticulosPublicados
{
    //db conn and table
    private $conn;
    private $table_name = "tb_articulos_publicados";

    //object properties
    public $id_articulo;
    public $titulo_articulo;
    public $fecha_creacion;
    public $fecha_publicacion;
    public $estado_articulo;
    public $fk_id_estado;
    public $visita_articulo;
    public $plantilla_articulo;
    public $fk_id_articulo;
    public $fk_id_usuario;

    //object imagen articulo
    public $id_articulo_imagen;
    public $path;

    //object parrafo articulo
    public $id_articulo_parrafo;
    public $parrafo_articulo;

    //object link aticulo
    public $id_articulo_link;
    public $link_articulo;

    //object sub categoria articulo
    public $categoria;
    public $sub_categoria;

    //by limit and offset
    public $limit;
    public $offset;

    //by subcategoria
    public $id_sub_categoria;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getArticulo(){
        $query = "SELECT * FROM tb_articulos_publicados WHERE id_articulo = ?";
        //prepare
        $stmt = $this->conn->prepare($query);
        //sanitize
        $this->id_articulo=htmlspecialchars(strip_tags($this->id_articulo));
        //bind foreign key and the path
        $stmt->bindParam(1, $this->id_articulo);
        //execute
        $stmt->execute();
        return $stmt;
    }

    public function getArticuloImagen(){
        $query = "SELECT * FROM tb_articulo_imagen_publicados WHERE fk_id_articulo = ?;";
        //prepare
        $stmt = $this->conn->prepare($query);
        //sanitize
        $this->fk_id_articulo=htmlspecialchars(strip_tags($this->fk_id_articulo));
        //bind foreign key and the path
        $stmt->bindParam(1, $this->fk_id_articulo);
        //execute
        $stmt->execute();
        //get values
        return $stmt;
    }

    public function getArticuloParrafo(){
        $query = "SELECT * FROM tb_articulo_parrafo_publicados WHERE fk_id_articulo = ?;";
        //prepare
        $stmt = $this->conn->prepare($query);
        //sanitize
        $this->fk_id_articulo=htmlspecialchars(strip_tags($this->fk_id_articulo));
        //bind foreign key and the path
        $stmt->bindParam(1, $this->fk_id_articulo);
        //execute
        $stmt->execute();
        //get values
        return $stmt;
    }

    public function getArticuloLink(){
        $query = "SELECT * FROM tb_articulo_link_publicados WHERE fk_id_articulo = ?;";
        //prepare
        $stmt = $this->conn->prepare($query);
        //sanitize
        $this->fk_id_articulo=htmlspecialchars(strip_tags($this->fk_id_articulo));
        //bind foreign key and the path
        $stmt->bindParam(1, $this->fk_id_articulo);
        //execute
        $stmt->execute();
        return $stmt;
    }

    public function getArticuloCategorias(){
        $query = "SELECT SC.nombre_sub_categoria AS sub_categoria, c.nombre_categoria as categoria 
            FROM tb_articulos a 
            LEFT OUTER JOIN tb_sub_categoria_articulo_publicados sa ON a.id_articulo = sa.fk_id_articulo 
            LEFT OUTER JOIN tb_sub_categorias sc ON sa.fk_id_sub_categoria = sc.id_sub_categoria 
            LEFT OUTER JOIN tb_categorias c ON sc.fk_id_categoria = c.id_categoria
            WHERE a.id_articulo = ?";
        //prepare
        $stmt = $this->conn->prepare($query);
        //sanitize
        $this->id_articulo=htmlspecialchars(strip_tags($this->id_articulo));
        //bind foreign key and the path
        $stmt->bindParam(1, $this->id_articulo);
        //execute
        $stmt->execute();
        return $stmt;
    }

    public function getAll() {
        $query = "SELECT s.id_articulo as id_articulo FROM tb_articulos_publicados s;";
        //prepare
        $stmt = $this->conn->prepare($query);
        //execute
        $stmt->execute();
        // return execute
        return $stmt;
    }

    public function getDestacados() {
        $query = "SELECT s.id_articulo as id_articulo, s.visita_articulo as visita FROM tb_articulos_publicados s ORDER BY s.visita_articulo DESC LIMIT 4;";
        //prepare
        $stmt = $this->conn->prepare($query);
        //execute
        $stmt->execute();
        // return execute
        return $stmt;
    }

    public function getLimitOffset($limit,$offset){
        $query = "SELECT s.id_articulo as id_articulo FROM tb_articulos_publicados s ORDER BY s.fecha_publicacion LIMIT ? OFFSET ?";
        //prepare
        $stmt = $this->conn->prepare($query);
        //bind foreign key and the path
        $stmt->bindParam(1, $limit, PDO::PARAM_INT);
        $stmt->bindParam(2, $offset, PDO::PARAM_INT);
        //execute
        $stmt->execute();
        // return execute
        return $stmt;
    }

    public function getArticuloTitulo(){
        $query = "SELECT * FROM tb_articulos_publicados WHERE titulo_articulo = ?;";
        //prepare
        $stmt = $this->conn->prepare($query);
        //sanitize
        $this->titulo_articulo=htmlspecialchars(strip_tags($this->titulo_articulo));
        //bind
        $stmt->bindParam(1,$this->titulo_articulo);
        //execute
        $stmt->execute();
        return $stmt;
    }

    public function searchDinamicByCategorias(){
        /**/
        $query = "SET @table_name:='tb_sub_categoria_articulo_publicados';";
        // prepare
        $stmt = $this->conn->prepare($query);
        //sanitize
        $this->id_sub_categoria=htmlspecialchars(strip_tags($this->id_sub_categoria));
        //bind
        $stmt->bindParam(1,$this->id_sub_categoria);
        //execute
        if ($stmt->execute()){
            $query = "SET @num:= ?;";
            // prepare
            $stmt = $this->conn->prepare($query);
            //sanitize
            $this->id_sub_categoria=htmlspecialchars(strip_tags($this->id_sub_categoria));
            //bind
            $stmt->bindParam(1,$this->id_sub_categoria);
            //lo ejecuto
            if ($stmt->execute()) {
                $query = "SET @sql:=CONCAT('SELECT * FROM ',@table_name, ' WHERE fk_id_sub_categoria =', @num);";
                // prepare
                $stmt = $this->conn->prepare($query);
                //lo ejecuto
                if ($stmt->execute()){
                    $query = "PREPARE dynamic_statement FROM @sql;";
                    // prepare
                    $stmt = $this->conn->prepare($query);
                    //lo ejecuto
                    if($stmt->execute()){
                        $query = "EXECUTE dynamic_statement;";
                        // prepare
                        $stmt = $this->conn->prepare($query);
                        //lo ejecuto
                        $stmt->execute();
                        return $stmt;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;   
            }
        } else {
            return array( "message" => "Error al declarar la variable de tabla.");
        }
    }

    public function updateVista(){
        $query = "UPDATE tb_articulos_publicados SET visita_articulo=visita_articulo + 1 WHERE id_articulo = ?;";
        //prepare
        $stmt = $this->conn->prepare($query);
        //bind
        $stmt->bindParam(1,$this->id_articulo, PDO::PARAM_INT);
        //execute
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

}
