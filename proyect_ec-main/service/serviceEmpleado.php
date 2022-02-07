<?php

include '../controladores/AdminController.php';
include '../model/UsuarioModel.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $dato="";
    $id="";
    $documento="";
    $nombre="";
    $apellido="";
    $direccion="";
    $telefono="";
    $usuario="";
    $pass="";
    $rol="";
    $porc="";

    if(isset($_POST['txtPor'])){
        $porc = $_POST['txtPor'];
    }

    if(isset($_POST['dato'])){
        $dato = $_POST['dato'];
    }
    
    if(isset($_POST['_id_'])){
        $id = $_POST['_id_'];
    }   

    if(isset($_POST['txtDoc'])){
        $documento = $_POST['txtDoc'];
    }   

    if(isset($_POST['txtNom'])){
        $nombre = $_POST['txtNom'];
    }   

    if(isset($_POST['txtAPE'])){
        $apellido = $_POST['txtAPE'];
    }   

    if(isset($_POST['txtDirec'])){
        $direccion = $_POST['txtDirec'];
    }   

    if(isset($_POST['txtTel'])){
        $telefono = $_POST['txtTel'];
    }   

    if(isset($_POST['slRol'])){
        $rol = $_POST['slRol'];
    }   

    if(isset($_POST['txtUS'])){
        $usuario = $_POST['txtUS'];
    }   

    if(isset($_POST['txtPass'])){
        $pass = $_POST['txtPass'];
    }

    $controller = new AdminController();
    $empleado = new UsuarioModel($id,$documento,$nombre,$apellido,$direccion,$telefono,$usuario,$pass,$rol);


    $result;

    switch ($dato) {
        case '1':
            # code...
            break;
        
        case '2':
            $result = $controller->setEmpleado($empleado);
            break;
        
        case '3':            
            $data = array('response' => true, 'Men'=>$controller->getTableEmpleadoById($empleado));
            $result = json_encode($data);
            break;

        case '4':
            $result = $controller->deleteEmpleado($id);
            break;
        case '5':
            $result = $controller->getTablePorcentaje();
            break;
        case '6':
            $result = $controller->setPorcentaje($porc);
            break;
        default:
            # code...
            break;
    }

    echo $result;

}