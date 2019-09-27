<?php
//Required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//Include db and object
include_once '../../config/database.php';
include_once '../../models/sub.categorias.php';

//New instances
$database = new Database();
$db = $database->getConnection();

$subCategorias = new SubCategorias($db);

$stmt = $subCategorias->getAllCategorias();
$num = $stmt->rowCount();

if($num > 0) {
    $pivote = 0;
    $a = array();

    //convert to array object with fetch all
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    /* $pivote = 0;
    $categoria = array();
    $subcategoria = array(); */

    //fixed array with left outer join
    /* for($i = 0;$i < count($row);$i++){

        if($i == 0){

            $convert = (object) $row[$i];
        } else {
            $convert = (object) $row[$i - 1];
        }
        
        $new = (object) $row[$i];
        
        $pivote = $convert->id_categoria;
        
        if($pivote == $new->id_categoria){

        } else {

            $subcategoria = array(
                "id_sub_categoria" => $new->id_sub_categoria,
                "nombre_sub_categoria" => $new->nombre_sub_categoria
            );

            echo json_encode($subcategoria);
            /* array_push($categoria[$new->nombre_categoria],$subcategoria); */
            /* echo json_encode($categoria); */
/*         }
    } */

    /* echo json_encode($categoria); */
    
    echo json_encode($row);
} else {
    echo json_encode(
        array("messege" => "No hay datos de los usuarios ingresados.")
    );
}

?>