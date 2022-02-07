<?php


include '../controladores/AdminController.php';



if($_SERVER["REQUEST_METHOD"] == "POST"){



}

public function getListCategorias()
{
    $controller = new AdminController();
    return $controller->getTableCategoria()->fetchAll();
}

public function getListadoProducto()
{
    $controller = new AdminController();
    return $controller->getTableProducto()->fetchAll();
}