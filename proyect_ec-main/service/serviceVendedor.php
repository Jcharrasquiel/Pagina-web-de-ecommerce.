<?php

include '../controladores/VendedorControlador.php';
include '../model/CartProductModel.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $dato = "";
    $id="";

    if(isset($_POST['dato'])){
        $dato = $_POST['dato'];
    }
    
    if(isset($_POST['id'])){
        $id = $_POST['id'];
    }

    $controller = new VendedorController();
    $result = "";

    switch ($dato) {
        case '1':
            $data = array('response' => true, 'Men'=>$controller->getInfoVent($id));
            $result = json_encode($data);
            break;
        
        default:
            # code...
            break;
    }


    echo $result;
}