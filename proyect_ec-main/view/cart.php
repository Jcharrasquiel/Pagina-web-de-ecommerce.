<?php
include '../controladores/VentaControlador.php';
$controller = new VentaController();
$session = $controller->getSession();
$cartProduct = $controller->getCartProduct();
$id;
if(isset($session['id'])){
  $id = $session['id'];
}
$total=0;
$idCart="";
if(isset($_SESSION['idCartP'])){
    $idCart =$_SESSION['idCartP'];
}

setlocale(LC_MONETARY, 'es-US');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/normalize.css">
    <link rel="stylesheet" href="../assets/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/styles_admin.css">
    <link rel="stylesheet" href="../assets/css/all.css">
    <title>Carrito</title>
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
                        <a class="nav-link" href="../index.php">Home </a>
                    </li>                    
                </ul> 
            </div>
            <div class="mt-2 mt-md-0">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                    <?php 
                        if($session){
                          $url ="#";
                          $rol = $session['rol'];
                          if($rol == 1){
                            $url = "../administrador/index.php";
                          }else if($rol == 2){
                            $url = "../vendedor/index.php";
                          }else{
                            $url = "../login/index.php";
                          }
                        ?>
                          <a class="nav-link" href="<?php echo $url;?>"><?php echo $session['NOM'];?></a>
                        <?php
                        }else{
                        ?>
                        <a class="nav-link" href="../login/index.php">Login</a>
                        <?php } ?>
                    </li>
                    <li class="nav-item">
                      <?php 
                        if($session){                        
                        ?>
                          <form id="frm_logout" name="frm_logout" action="../service/serviceAuth.php"  method="post">
                            <input type="hidden" name="txtOp" value="1">
                            <a class="nav-link" onclick="logout()" href="#">Salir</a>
                          </form>
                        <?php
                        }
                        ?>
                    </li>                    
                </ul> 
            </div>
        </div>
    </nav>
    
    <!--CONTAINER-->
    <div class="container">
        <div class="card">
            <div class="card-header d-flex">
                <h5>Listado del Carrito</h5>                
            </div>       
            <div class="card-body">
                <?php
                    if(!$cartProduct){
                        echo '<h1>No tiene productos en el carrito de compras!!!</h1>';
                    }else{
                ?>
                    <table id="table_id" class="table table-default display">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Cantidad</th>                            
                                <th>Total a pagar</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($cartProduct as $e){
                                    $total = $total+$e['TOTAL'];
                                    echo '<tr>';
                                        echo '<td>' .$e['NOM'].'</td>';
                                        echo '<td>' .$e['ST'].'</td>';
                                        echo '<td> $ ' .number_format($e['TOTAL']).'</td>';
                            ?>   
                                        <td>
                                        <a href="#" onclick="modal_update_cartProc('<?php echo $e['ID'] ?>','2')" class="btn btn-warning"><i class="far fa-edit"></i></a>
                                        -
                                        <a href="#" onclick="modal_del_cartProc('<?php echo $e['ID']; ?>','<?php echo $idCart;?>')" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                        </td>   
                            <?php              
                                    echo '<tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                    <h2>Total a pagar: <?php echo '$ ' .number_format($total);?></h2>
                <?php
                    }
                ?>
            </div>
            <div class="card-footer">
                  <?php
                          $estado = isset($session['rol']);


                          if($cartProduct && $estado){
                            if($session['rol'] == 2){
                  ?>                
                    <a href="#" onclick="modal_fin_vent('<?php echo $id;?>')" id="btn_fin_vt" class="btn btn-success">Finalizar Venta</a>
                  <?php
                            }
                          }
                  ?>
                  <?php 
                      if($idCart != null){
                  ?>
                        <a href="#" onclick="modal_delete_cart('<?php echo $idCart;?>')" class="btn btn-warning">Eliminar el carrito</a>
                  <?php
                      }
                      ?>
            </div>
        </div>
    </div>
    
    
    <!--MODAL PRODUCTO-->
    <div class="modal fade" id="modal_c">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modificar pedido</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="../service/serviceVentas.php" id="frm_up_cart" name="frm_up_cart" method="post">
                <input type="hidden" id="_id" name="_id_" value="-1">
                <input type="hidden" id="_dato" name="dato" value="6">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="txtCod">Codigo</label>
                        <input type="text" disabled class="form-control" id="txtCod">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtNom">Nombre</label>
                        <input type="text" class="form-control" id="txtNom" name="txtNom"  readonly="readonly">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="txtStock">Stock</label>
                        <input type="text" disabled class="form-control" id="txtStock">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtCad">Cantidad a vender</label>
                        <input type="number" class="form-control" id="txtCad" name="txtCad">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="txtPV">Precio de venta</label>
                        <input type="text" disabled class="form-control" name="txtPV" id="txtPV">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtTotal">Total a pagar</label>
                        <input type="text" class="form-control" name="txtTotal" id="txtTotal" readonly="readonly">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Agregar</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal_p">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Eliminar del carrito</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form action="../service/serviceVentas.php" id="frm_del_cart" name="frm_del_cart" method="post">
                <input type="hidden" id="_id_" name="_id_" value="-1">
                <input type="hidden" id="_idC" name="id_c" value="-1">
                <input type="hidden" id="dato" name="dato" value="7">
                <h3>Se eliminarán el producto de este carrito.</h3>
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

    <div class="modal fade" id="modal_e">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Eliminar el carrito</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form action="../service/serviceVentas.php" id="frm_del_all" name="frm_del_all" method="post">
                <input type="hidden" id="id_" name="_id_" value="-1">
                <input type="hidden" id="dato" name="dato" value="9">
                <h3>Se eliminará todo el carrito de compras.</h3>
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
    <script src="../assets/js/main.js"></script>
</body>
</html>