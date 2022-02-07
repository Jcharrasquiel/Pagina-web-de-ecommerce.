<?php

include '../controladores/AdminController.php';
include '../model/CategoriaModel.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $txtCategoria="";
    $txtIDC=0;
    $txtC="";
    $txtIDCC="";

    if(isset($_POST['txtCategoria'])){
        $txtCategoria = $_POST['txtCategoria'];
    }
    if(isset($_POST['txtIDC'])){
        $txtIDC = $_POST['txtIDC'];
    }
    if(isset($_POST['txtC'])){
        $txtC = $_POST['txtC'];
    }   
    if(isset($_POST['txtIDCC'])){
        $txtIDCC = $_POST['txtIDCC'];
    }   

    if($txtIDCC > 0){
        $txtIDC = $txtIDCC;
    }

    $controller = new AdminController();
    $categoria = new CategoriaModel($txtIDC,$txtCategoria);

    $result;

    switch ($txtC) {
        case '1':
            
            break;
        case '2':
            $result = $controller->setCategoria($categoria);
            break;
        case '3':
            $result = $controller->getTableCategoriaById($categoria);
            break;
        case '4':
            $result = $controller->deleteCategoria($categoria);
            break;
        default:
            # code...
            break;
    }

    echo $result;
    

}else{
    $data = array('response' => false, 'Men'=>'Se esta enviando un METHOD no valido');
    echo json_encode($data);
}