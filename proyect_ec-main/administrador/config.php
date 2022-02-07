<?php
include '../controladores/AdminController.php';
$controller = new AdminController();
$session = $controller->getSession();
$porcentaje = 0;
$result = $controller->getTablePorcentaje();
if(!$result){
    $porcentaje = 0;
}else{
    $porcentaje = $result['POR'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/normalize.css">
    <link rel="stylesheet" href="../assets/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/datatables.min.css">
    <link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/css/all.css">
    <link rel="stylesheet" href="../assets/css/styles_admin.css">
    <title>Document</title>
</head>
<body>
    
    <!--BANNER-->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">        
        <a class="navbar-brand" href="../index.php">Mi Tienda</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="container">                
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home </a>
                    </li>                    
                    <li class="nav-item">
                        <a class="nav-link" href="empleado.php">Empleados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cliente.php">Cliente</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="config.php">Configuracion</a>
                    </li>
                </ul> 
            </div>
            <div class="mt-2 mt-md-0">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><?php echo $session['NOM'];?></a>
                    </li>
                    <li class="nav-item">
                        <form id="frm_logout" name="frm_logout" action="../service/serviceAuth.php"  method="post">
                        <input type="hidden" name="txtOp" value="1">
                        <a class="nav-link" onclick="logout()" href="#">Salir</a>
                        </form>
                    </li> 
                </ul> 
            </div>
        </div>
    </nav>

    <!--Container-->
    <div class="container">
        <div class="card">
            <div class="card-header d-flex">
                <h5>Porcentaje de ganancias del vendedor</h5>
            </div>            
            <div class="card-body">                
                <form action="../service/serviceEmpleado.php" id="frm_reg_conf" name="frm_reg_conf" method="post">
                    
                    <input type="hidden" name="dato" id="dato" value="6">

                    <div class="form-group">
                        <label for="txtPor">Porcentaje</label>
                        <input step="any" type="number" class="form-control" id="txtPor" name="txtPor" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </form>
                <br>
                <h4>Porcentaje actual de ganancias: <?php echo $porcentaje;?>  </h4>
            </div>            
        </div>
    </div>  

    <!--MODAL PRODUCTO-->
    <div class="modal fade" id="modal_p">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro/Actualizacion de un cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../service/clienteService.php" id="reg_new_cliente" name="reg_new_cliente" method="post">
                    
                    <input type="hidden" name="dato" id="dato" value="2">
                    <input type="hidden" name="_id_" id="_id_" value="-1">

                    <div class="form-group">
                        <label for="txtDoc">Documento</label>
                        <input type="number" class="form-control" id="txtDoc" name="txtDoc" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="txtNom">Nombre</label>
                            <input type="text" class="form-control" id="txtNom" name="txtNom">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="txtAPE">Apellido</label>
                            <input type="text" class="form-control" id="txtAPE" name="txtAPE" required>
                        </div>
                    </div>                                        
                    <div class="form-group">
                        <label for="slVend">Vendedor</label>
                        <select class="form-control" name="slVend" id="slVend">
                        </select>
                    </div>                    
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                
            </div>
            </div>
        </div>
    </div>    

    <div class="modal fade" id="modal_del_p">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="id_reg_c">Eliminar registros</h5>                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">                
                <form action="../service/clienteService.php" name="delete_cli" id="delete_cli" method="post">
                    <input type="hidden" name="_id_" id="_id" value="-1">                    
                    <input type="hidden" name="dato" id="dato" value="4">                    
                    <h3>Se eliminarán todos los datos asociados a este registro.</h3>
                    <h2>¿Desea continuar?</h2>
                    <button type="submit"class="btn btn-danger">Si</button>                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                
            </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/js/admin.js"></script>
</body>
</html>