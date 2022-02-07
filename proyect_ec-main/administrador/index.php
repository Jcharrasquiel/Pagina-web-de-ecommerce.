<?php
include '../controladores/AdminController.php';

$controller = new AdminController();
$session = $controller->getSession();
$categoria = $controller->getTableCategoria()->fetchAll();
$product = $controller->getTableProducto()->fetchAll();
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
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home </a>
                    </li>                    
                    <li class="nav-item">
                        <a class="nav-link" href="empleado.php">Empleados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cliente.php">Cliente</a>
                    </li>
                    <li class="nav-item">
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
    <div class="card">
        <div class="card-header d-flex">
            <h5>Listado del inventario</h5>                
        </div>       
        <div class="card-body">                
            <div class="row">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header d-flex">
                            <h5>Listado de productos</h5>
                            <a id="btnAddProc" href="#" class="btn btn-primary ml-auto">Agregar</a>                            
                        </div>            
                        <div class="card-body">                
                            <table id="tabled" class="table table-default display">
                                <thead>
                                    <tr>
                                        <th>Imagen</th>
                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                        <th>Precio Compra</th>
                                        <th>Precio Venta</th>
                                        <th>Stock</th>
                                        <th>Categoria</th>
                                        <th>Opciones</th>                                           
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                        foreach($product as $p){
                                            echo '<tr>';
                                    ?>
                                                <td>
                                                <img src="<?php echo $p['IMG'];?>" alt="..." height="100px" width="100px">
                                                </td>
                                    <?php                                                
                                                echo '<td>' .$p['COD'].'</td>';
                                                echo '<td>' .$p['NOM'].'</td>';
                                                echo '<td>' .$p['DES'].'</td>';
                                                echo '<td>' .$p['PC'].'</td>';
                                                echo '<td>' .$p['PV'].'</td>';
                                                echo '<td>' .$p['STO'].'</td>';
                                                echo '<td>' .$p['CT'].'</td>';
                                    ?>                                    
                                                <td>
                                                <a href="#" onclick="btn_prod_up('<?php echo $p['ID'];?>')" class="btn btn-warning"><i class="far fa-edit"></i></a>
                                                -
                                                <a href="#" onclick="btn_prod_del('<?php echo $p['ID'];?>')" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                                </td>
                                    <?php
                                            echo '</tr>';
                                        }
                                    ?>                                    
                                </tbody>
                            </table>
                        </div>            
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header d-flex">
                            <h5>Listado de categorias</h5> 
                            <a href="#" id="btnAddCat" class="btn btn-primary ml-auto">Agregar</a>                           
                        </div>       
                        <div class="card-body">                
                            <table id="table_id" class="table table-default display">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Nombre</th>                            
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach($categoria as $e){
                                            echo '<tr>';
                                                echo '<td>' .$e['ID'].'</td>';
                                                echo '<td>' .$e['NOM'].'</td>';
                                    ?>   
                                                <td>
                                                <a href="#" onclick="showModalCategoria('<?php echo $e['ID'] ?>','2')" class="btn btn-warning"><i class="far fa-edit"></i></a>
                                                -
                                                <a href="#" onclick="showModalDeleteCategoria('<?php echo $e['ID'] ?>')" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                                </td>   
                                    <?php              
                                            echo '<tr>';
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>            
                    </div>
                </div>
            </div>
        </div>            
    </div>   

    <!--MODAL PRODUCTO-->
    <div class="modal fade" id="modal_p">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro/Actualizacion de un producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../service/serviceProducto.php" id="reg_new_prod" name="reg_new_prod" method="post">
                    
                    <input type="hidden" name="dato" id="dato" value="2">
                    <input type="hidden" name="_id_" id="_id_" value="-1">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="txtCod">Codigo</label>
                            <input type="text" class="form-control" id="txtCod" name="txtCod">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="txtNom">Nombre</label>
                            <input type="text" class="form-control" id="txtNom" name="txtNom">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtDescripcion">Descripcion</label>
                        <textarea class="form-control" id="txtDescripcion"  name="txtDescripcion"rows="3"></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="txtPC">Precio Compra</label>
                            <input type="number" class="form-control" id="txtPC" name="txtPC">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="txtPV">Precio Venta</label>
                            <input type="number" class="form-control" id="txtPV" name="txtPV">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="txtStock">Stock</label>
                            <input type="number" class="form-control" id="txtStock" name="txtStock">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="slCat">Categoria</label>
                            <select class="form-control" name="slCat" id="slCat">
                                
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtImagen">Imagen</label>
                        <input type="text" class="form-control" id="txtImagen" name="txtImagen">
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

    <div class="modal fade" id="modal_c">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="id_reg_c">Registro/Actualizacion de una categoria</h5>                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../service/serviceCategoria.php" name="reg_new_cat" id="reg_new_cat" method="post">
                    <input type="hidden" name="txtIDC" id="txtIDC" value="-1">
                    <input type="hidden" name="txtC" id="txtC" value="2">
                    <div class="form-group">
                        <label for="txtCategoria">Categoria</label>
                        <input type="text" class="form-control" id="txtCategoria" name="txtCategoria">
                    </div>
                    <button type="submit"class="btn btn-primary">aceptar</button>                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                
            </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal_del">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="id_reg_c">Eliminar registros</h5>                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../service/serviceCategoria.php" name="delete_cat" id="delete_cat" method="post">
                    <input type="hidden" name="txtIDCC" id="txtIDCC" value="-1">                    
                    <input type="hidden" name="txtC" id="txtC" value="4">                    
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
                <form action="../service/serviceProducto.php" name="delete_pro" id="delete_pro" method="post">
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