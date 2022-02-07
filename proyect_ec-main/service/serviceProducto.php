<?php
include '../controladores/AdminController.php';
include '../model/ProductoModel.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){


    $dato="";
    $id="";
    $codigo="";
    $nombre="";
    $descripcion="";
    $precV="";
    $precC="";
    $stock="";
    $img="";
    $categoria="";


    if(isset($_POST['dato'])){
        $dato = $_POST['dato'];
    }    

    if(isset($_POST['_id_'])){
        $id = $_POST['_id_'];
    }
    if(isset($_POST['txtCod'])){
        $codigo = $_POST['txtCod'];
    }
    
    if(isset($_POST['txtNom'])){
        $nombre = $_POST['txtNom'];
    }
    
    if(isset($_POST['txtDescripcion'])){
        $descripcion = $_POST['txtDescripcion'];
    }
    
    if(isset($_POST['txtPV'])){
        $precV = $_POST['txtPV'];
    }
    
    if(isset($_POST['txtPC'])){
        $precC = $_POST['txtPC'];
    }
    
    if(isset($_POST['txtStock'])){
        $stock = $_POST['txtStock'];
    }
    
    if(isset($_POST['txtImagen'])){
        $img = $_POST['txtImagen'];
    }
    
    if(isset($_POST['slCat'])){
        $categoria = $_POST['slCat'];
    }
    


    $controller = new AdminController();
    $producto = new ProductoModel($id,$codigo,$nombre,$descripcion,$precV,$precC,$stock,$img,$categoria);


    $result;

    switch ($dato) {
        case '1':
            $result = $controller->getTableProducto();
            break;
        case '2':
            $result = $controller->setProducto($producto);
            break;
        case '3':
            $data = array('response' => true, 'Men'=>$controller->getTableProductoByID($id),'MenCT' => $controller->getTableCategoria()->fetchAll());
            $result = json_encode($data);            
            break;
        case '4':
            $result = $controller->deleteProducto($id);
            break;
        case '5':
            $data = array('response' => true, 'Men'=>$controller->getTableCategoria()->fetchAll());
            $result = json_encode($data);
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