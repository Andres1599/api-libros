<?php
//header method for the request register
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset:UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//Req includes
include_once '../../config/database.php';
include_once '../../models/sub.categorias.php';

//Db conn and instances
$database = new Database();
$db=$database->getConnection();

try {

    $subCategorias = new SubCategorias($db);

    //Get post data
    $data = json_decode(file_get_contents("php://input"));
    
    //set usuarios values
    $subCategorias->id_sub_categoria = $data->id_sub_categoria;

    if ($subCategorias->deleteSubCat()) {
        echo json_encode(
            array(
                "message" => "Se ha eliminado la subcategoria.",
                "delete" => "true"
            )
        );
    } else {
        echo json_encode(
            array(
                "message" => "No se ha podido eliminar la subcategoria.",
                "delete" => "false"
            )
        );
    }
} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}

?>