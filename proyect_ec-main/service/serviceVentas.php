<?php

include '../controladores/VentaControlador.php';
include '../model/CartProductModel.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $dato="";
    $id="";
    $isClient="";
    $nombre="";
    $stock="";
    $total="";
    $txtidCartP ="";

    if(isset($_POST['isClient'])){
        $isClient = $_POST['isClient'];
    } 

    if(isset($_POST['dato'])){
        $dato = $_POST['dato'];
    } 

    if(isset($_POST['id_c'])){
        $txtidCartP = $_POST['id_c'];
    } 

    if(isset($_POST['_id_'])){
        $id = $_POST['_id_'];
    }  

    if(isset($_POST['txtNom'])){
        $nombre = $_POST['txtNom'];
    }

    if(isset($_POST['txtCad'])){
        $stock = $_POST['txtCad'];
    }

    if(isset($_POST['txtTotal'])){
        $total = $_POST['txtTotal'];
    }

    $controller = new VentaController();
    $cartProduct = new CartProductModel($id,$nombre,$stock,$total);

    $result;

    switch ($dato) {
        case '1':
            $result = $controller->setProductToCart($cartProduct);
            break;
        case '2':
            $data = array('response' => true, 'Men'=> $controller->getProductForCart($id));
            $result = json_encode($data);
            break;
        case '3':            
            $data = array('response' => true, 'Men'=> $controller->removeCartProduct($id));
            $result = json_encode($data);
            break;
        case '4':
            $data = array('response' => false, 'Men'=> $controller->getClienteByVendedor($id));
            $result = json_encode($data);
            break;
        case '5':
            $result = $controller->setFinVenta($id,$txtidCartP,$isClient);
            break;
        case '6':
            $data = array('response' => false, 'Men'=> $controller->getCartProductByID($id));
            $result = json_encode($data);
            break;
        case '7':
            $result = $controller->deleteProdutOfCartProduct($id,$txtidCartP);
            break;
        case '8':
            $result = $controller->setUpdateProductToCartProduct($cartProduct,$id);
            break;
        case '9':
            $result = $controller->detDeleteAllCartProduct($id);
            break;
        default:
            # code...
            break;
    }

    echo $result;

}