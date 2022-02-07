<?php
include '../controladores/VentaControlador.php';
$controller = new VentaController();
$session = $controller->getSession();
$id="";
$product = "";
if(isset($_GET['id'])){
    $id = $_GET['id'];
}
if($id != null){
    $product = $controller->getProductoByID($id);
}else{
    echo "<script language=\"javascript\">
                    window.location.href=\"../index.php\";
                    </script>";
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
    <link rel="stylesheet" href="../assets/css/styles_admin.css">
    <title>Detalles del producto</title>
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
        <div class="card ">
            <div class="card-header">
                <h3>Detalles del producto</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="col-12">
                            <img src="<?php echo $product['IMG']; ?>" alt="..." height="400px" width="400px"class="product-image" alt="Product Image">                            
                          </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <h3 class="my-3"><?php echo $product['NOM']; ?></h3>
                        <p><?php echo $product['DES']; ?></p>
                        <hr>

                        <form action="#" id="compraPD" method="post">
                            <div class="mt-4">
                                  <div class="form-group">
                                    <label for="stockAPD">Stock</label>
                                    <input class="form-control" id="stockAPD" type="text" placeholder="Stock" value="<?php echo $product['STO']; ?>" readonly>
                                  </div>
                            </div>
                        </form>                        
                        
                    </div>
                </div>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>    


    <!--MODAL-->
    <div class="modal fade" id="modal_c">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Comprar el producto</h5>
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
    <script src="../assets/js/main_v_client.js"></script>

</body>
</html>