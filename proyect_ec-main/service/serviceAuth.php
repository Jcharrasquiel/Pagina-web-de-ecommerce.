<?php

include '../controladores/AuthController.php';
include '../model/CartProductModel.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $user;
    $pass;
    $op = 0;

    if(isset($_POST['txtUser'])){
        $user = $_POST['txtUser'];
    }

    if(isset($_POST['txtPass'])){
        $pass = $_POST['txtPass'];
    }

    if(isset($_POST['txtOp'])){
        $op = $_POST['txtOp'];
    }

    $controller = new AuthController();
    $result;

    switch ($op) {
        case '0':
            $result = $controller->setSessionLogin($user,$pass);
            break;
        case '1':
            $result = $controller->getLogout();
            break;
        default:
            # code...
            break;
    }

    echo $result;
}
?>