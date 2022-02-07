<?php

include '../controladores/AdminController.php';
include '../model/ClienteModel.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $dato="";
    $id="";    
    $nombre="";
    $apellido="";
    $doc="";
    $vendedor="";
    $tel="";

    if(isset($_POST['txtTel'])){
        $tel = $_POST['txtTel'];
    } 

    if(isset($_POST['dato'])){
        $dato = $_POST['dato'];
    } 

    if(isset($_POST['_id_'])){
        $id = $_POST['_id_'];
    } 

    if(isset($_POST['txtDoc'])){
        $doc = $_POST['txtDoc'];
    } 

    if(isset($_POST['txtNom'])){
        $nombre = $_POST['txtNom'];
    } 

    if(isset($_POST['txtAPE'])){
        $apellido = $_POST['txtAPE'];
    } 

    if(isset($_POST['slVend'])){
        $vendedor = $_POST['slVend'];
    }

    $controller = new AdminController();
    $cliente = new ClienteModel($id,$nombre,$apellido,$doc,$vendedor,$tel);

    $result="";

    switch ($dato) {
        case '1':
            # code...
            break;
        case '2':
                $result = $controller->setCliente($cliente);
            break;
        case '3':
            $data = array('response' => true, 'Men'=>$controller->getTableClienteById($id), 'DES'=>$controller->getListEmpleado()->fetchAll());
            $result = json_encode($data);
            break;
        case '4':
                $result = $controller->deleteClient($id);
            break;
        case '5':
            $data = array('response' => true, 'Men'=>$controller->getListEmpleado()->fetchAll());
            $result = json_encode($data);
            break;
        default:
            # code...
            break;
    }

    echo $result;

}