<?php
include '../controladores/VentaControlador.php';
$controller = new VentaController();
$session = $controller->getSession();
$listP = $controller->getListProduct();
$listC = $controller->getListCategoria();
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
    <title>index</title>
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
                        <a class="nav-link" href="cart.php">Carrito</a>
                    </li>
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
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">Categorias</div>
                    <ul class="list-group list-group-flush">
                        <?php
                          foreach($listC as $c){                          
                        ?>
                            <li class="list-group-item"><a href="cat.php?id=<?php echo $c['ID'];?>"><?php echo $c['NOM'];?></a></li>
                        <?php
                          }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-8">
                <?php
                  foreach($listP as $p){
                ?>
                  <div class="card mb-3">
                    <div class="row no-gutters">
                      <div class="col-md-4">
                        <img src="<?php echo $p['IMG'];?>" alt="..." height="200px" width="200px">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title"><?php echo $p['NOM'];?></h5>
                          <p class="card-text"><?php echo $p['DES'];?></p>
                        </div>
                        <div class="card-footer d-flex"><a href="#" onclick="modal_add_cart_idex('<?php echo $p['ID'];?>')" class="btn btn-primary">Agregar al carrito</a> <a href="http://localhost/proyect_ec/view/details.php?id=<?php echo$p['ID'];?>" class="btn btn-info ml-auto">Detalles</a></div>
                      </div>
                    </div>
                  </div>
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
            <h5 class="modal-title" id="exampleModalLabel">Agregar al carrito de compras</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="../service/serviceVentas.php" id="frm_add_cart" name="frm_add_cart" method="post">
                <input type="hidden" id="_id" name="_id_" value="-1">
                <input type="hidden" id="dato" name="dato" value="2">
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
            <h5 class="modal-title" id="exampleModalLabel">Vender producto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>

      <script src="../assets/js/jquery-3.6.0.min.js"></script>
      <script src="../assets/js/bootstrap.min.js"></script>            
    <script src="../assets/js/main.js"></script>
</body>
</html>