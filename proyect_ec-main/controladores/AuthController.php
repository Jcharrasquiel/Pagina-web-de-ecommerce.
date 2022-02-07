<?php

include "../connection/ConexionMySQLPHP.php";

class AuthController
{
    
    protected $isSession;
    private $con;

    public function __construct()
    {
        $conexion = new ConexionMySQLPHP("localhost", "proyecto", "root", "");
        $this->con = $conexion->getConexion();
        $this->sessionStart();
    }

    public function getConexion()
    {
        return $this->con;
    }


    public function sessionStart()
    {
        session_start();
    }

    public function getSession()
    {
        if(isset($_SESSION['login']))
            return $_SESSION['login'];
    }

    public function setSessionLogin($user,$pass)
    {
        $query = "SELECT empleado.id AS ID,	empleado.documento AS DOC, empleado.nombre AS NOM, empleado.apellido AS APE, empleado.rol AS ROL FROM empleado WHERE	empleado.usuario = ? AND empleado.contrasena = ?";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(1,$user);
        $stmt->bindParam(2,$pass);
        $stmt->execute();
        $isSession = $stmt->fetch();
        if($isSession != null){

            $date = array('id' => $isSession['ID'], 'NOM' => $isSession['NOM'].' - '.$isSession['APE'], 'rol' => $isSession['ROL'], 'session' => true );
            $_SESSION['login'] = $date;
            
            $data = array('error' => false, 'Men'=> 'Bienvenido!!!!');
            echo json_encode($data);

        }else{
            $data = array('error' => true, 'Men'=> 'El usuario o contraseña son incorrectos, verifique e intente nuevamente');
            echo json_encode($data);
        }
    }

    public function getLogout()
    {
        session_unset();
        session_destroy();
        $data = array('response' => true, 'Men'=>'Datos registrados correctamente');
        return json_encode($data);
    }

    public function setProductCart($data)
    {
        $id;
        $cartProduct = isset($_SESSION['cartProduct']);
        $result;
        $op;
        if(!$cartProduct){
            $op = 1;
            $id = uniqid();
            $_SESSION['cartProduct'] = true;
            $_SESSION['idCartP'] = $id;
        }else{
            $op = 2;
            $id = $_SESSION['idCartP'];
        }

        $result = $this->setRegisterProduct($data,$id);

        if($result){
            $data = array('response' => false, 'Men'=>'Producto agregado al carrto de compras');
            return json_encode($data);
        }else{
            unset($_SESSION['cartProduct']);
            unset($_SESSION['idCartP']);
            $data = array('response' => true, 'Men'=>'El producto no pudo ser agregado');
            return json_encode($data);
        }
        
    }

    private function setRegisterProduct($data,$id)
    {
        $query = "INSERT INTO `proyecto`.`cartproduct` (`id_cart`, `id_pr`, `nom_p`, `stock`, `total`) VALUES (?,?,?,?,?)";
        $stmt = $this->con->prepare($query);
        $stmt -> bindParam(1,$id);
        $stmt -> bindParam(2,$data->id );
        $stmt -> bindParam(3,$data->nombre );
        $stmt -> bindParam(4,$data->stock );
        $stmt -> bindParam(5,$data->total );
        return $stmt->execute();
    }

    public function setUpdateProductStock($data)
    {
        $query = "UPDATE `proyecto`.`producto` SET `stock` = 89 WHERE `id` = ?";
        $stmt = $this->con->prepare($sql);
        $stmt -> bindParam(1,$data->id );
        return $stmt ->execute();
    }

    public function getCartProduct()
    {
        $id = $_SESSION['idCartP'];
        $query = "SELECT cartproduct.id_cart AS ID_CART, cartproduct.id_pr AS ID_P, cartproduct.nom_p AS NOM, 	cartproduct.stock AS ST, 	cartproduct.total AS TOTAL, cartproduct.id AS ID FROM cartproduct WHERE cartproduct.id_cart =?";
        $stmt = $this->con->prepare($query);
        $stmt -> bindParam(1,$id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function deleteSessionData()
    {
        unset($_SESSION['cartProduct']);
        unset($_SESSION['idCartP']);
    }

    public function isCartProduct()
    {
        if(isset($_SESSION['cartProduct'])){
            return $_SESSION['cartProduct'];
        }else{
            return false;
        }
    }

    public function removeProductOfCartCart($id)
    {
        $sql="DELETE FROM cartproduct WHERE cartproduct.id =?";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(1,$id);
        return $stmt ->execute();
    }

    public function removeCartProduct($id)
    {
        $sql="DELETE FROM cartproduct WHERE cartproduct.id_cart =?";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(1,$id);
        return $stmt->execute();
    }

    public function updateSessionUser($data)
    {
        
    }


}
