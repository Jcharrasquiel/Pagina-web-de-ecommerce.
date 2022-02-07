<?php

include "../controladores/AuthController.php";

class VendedorController
{
    private $con;
    private $auth;    

    public function __construct()
    {
        $this->auth = new AuthController();
        $this->con = $this->auth->getConexion();
    }

    public function getSession()
    {
        $data = $this->auth->getSession();
        if($data){
            if($data['rol'] != 2){
                echo "<script language=\"javascript\">
                    window.location.href=\"../login/index.php\";
                    </script>";
            }else{
                return $data;
            }
        }else{
            echo "<script language=\"javascript\">
                window.location.href=\"../login/index.php\";
                </script>";
        }
    }

    public function getAllVentas($id)
    {
        $query = "SELECT venta.fech AS FECH, cliente.nombre AS NOMC, cliente.apellido AS APEC, 	empleado.id AS ID_E, 	venta.id_v AS IDV, COUNT(cartproduct.id_pr) AS COUNT_P, SUM(cartproduct.total) AS SUN_a,cartproduct.id_cart AS ID_CART FROM	venta	INNER JOIN	cliente	ON 		venta.id_client = cliente.id	INNER JOIN	cartproduct	ON 	venta.id_cart_p = cartproduct.id_cart	INNER JOIN	empleado ON venta.id_ven = empleado.id AND cliente.vendedor = empleado.id WHERE empleado.id =? GROUP BY venta.id_v";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(1,$id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getProductVenta($id)
    {
        $query = "SELECT cartproduct.stock AS ST, cartproduct.total AS TOT,	producto.codigo AS COD, 	producto.nombre AS NOM, 	producto.precio_v AS PV, categoria.nombre AS CAT FROM	cartproduct	INNER JOIN	producto	ON 		cartproduct.id_pr = producto.id	INNER JOIN	categoria ON 		producto.categoria = categoria.id WHERE	cartproduct.id_cart =?";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(1,$id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getTableCliente($id)
    {
        $query = "SELECT cliente.id AS ID,  cliente.nombre AS NOM,  cliente.apellido AS APE, cliente.telefono AS TEL, cliente.documento AS DOC, empleado.nombre AS NOMV, empleado.apellido AS APEV FROM cliente INNER JOIN	empleado	ON cliente.vendedor = empleado.id WHERE empleado.id = ?";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(1,$id);
        $stmt->execute();
        return $stmt;
    }

    public function getInfoVent($id)
    {
        $query = "SELECT producto.codigo AS COD, producto.nombre AS NOM, producto.precio_v AS P_V, cartproduct.total AS TOTAL, categoria.nombre AS CAT, cartproduct.stock AS CANT FROM producto INNER JOIN cartproduct	ON producto.id = cartproduct.id_pr	INNER JOIN categoria	ON producto.categoria = categoria.id	INNER JOIN venta	ON cartproduct.id_cart = venta.id_cart_p WHERE	venta.id_v = ?";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(1,$id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getInfoVendedor($id)
    {
        $query = "SELECT venta.fech AS FECH, SUM(cartproduct.total) AS TOTAL, config.porcentaje AS PRG, (SUM(cartproduct.total)*config.porcentaje) AS GAN FROM venta	INNER JOIN cartproduct	ON venta.id_cart_p = cartproduct.id_cart, config WHERE	venta.id_ven = ? GROUP BY venta.id_v";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(1,$id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}
