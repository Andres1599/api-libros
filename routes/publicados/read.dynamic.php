<?php
//header method for the request register
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset:UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//Req includes
include_once '../../config/database.php';
include_once '../../models/articulo.publicado.php';

//Db conn and instances
$database = new Database();
$db=$database->getConnection();

try {
    $articulos = new ArticulosPublicados($db);
    //Get post data
    $data = json_decode(file_get_contents("php://input"));
    //set values
    $articulos->id_sub_categoria = $data->id_sub_categoria;
    //execute values
    $stmt = $articulos->searchDinamicByCategorias();
    //leor lo que hay en el stmt
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //creao un array para tener todos los articulos
    $all_Articles = array();

    foreach($row as $key => $object)
 	{
        $articulos->fk_id_articulo = $object['fk_id_articulo'];
        $articulos->id_articulo = $object['fk_id_articulo'];

        $stmt = $articulos->getArticulo();
        $stmt_a = $articulos->getArticuloImagen();
        $stmt_b = $articulos->getArticuloParrafo();
        $stmt_c = $articulos->getArticuloLink();
        $stmt_d = $articulos->getArticuloCategorias();

        //seteo todos los complementos del articulo
        $imagen = $stmt_a->fetchAll(PDO::FETCH_ASSOC);
        $categoria = $stmt_d->fetchAll(PDO::FETCH_ASSOC);
        $link = $stmt_c->fetchAll(PDO::FETCH_ASSOC);
        $parrafos = $stmt_b->fetchAll(PDO::FETCH_ASSOC);
        $art = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $articulo_all = array(
            "articulo"=> $art,
            "imagenes" => $imagen,
            "parrafos" =>  $parrafos,
            "links" => $link,
            "categorias" => $categoria
        );

        array_push($all_Articles, $articulo_all);
    }

    echo json_encode($all_Articles);
} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}
?>