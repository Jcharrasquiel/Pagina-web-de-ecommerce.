<?php
include '../controladores/VendedorControlador.php';
$controller = new VendedorController();
$session = $controller->getSession();
$listV = $controller->getAllVentas($session['id']);
$listInfo = $controller->getInfoVendedor($session['id']);
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
                        <a class="nav-link" href="cliente.php">Cliente</a>
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
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-header d-flex">
                    <h5>Listado de ventas realizadas </h5>                
                </div>       
                <div class="card-body">
                    <table id="tabled" class="table table-default display">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Cantidad vendida</th>
                                <th>Total Pagado</th>
                                <th>Ver detalles</th>                                           
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                                foreach($listV as $p){
                                    echo '<tr>';
                                        echo '<td>' .$p['FECH'].'</td>';
                                        echo '<td>' .$p['NOMC'].'-'.$p['NOMC'].'</td>';
                                        echo '<td>' .$p['COUNT_P'].'</td>';
                                        echo '<td> $' .number_format($p['SUN_a']).'</td>';
                            ?>                                    
                                        <td>
                                            <a href="#" onclick="details('<?php echo $p['IDV'];?>')" class="btn btn-warning"><i class="far fa-edit"></i></a>
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
        <div class="col-4">
            <div class="card">
                <div class="card-header d-flex">
                    <h5>Listado de ganancias por ventas </h5>                
                </div>       
                <div class="card-body">
                    <table id="tabled" class="table table-default display">
                        <thead>
                            <tr>
                                <th>Venta</th>
                                <th>Total</th>
                                <th>Ganancias</th>
                                <th>Porcentaje</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                                foreach($listInfo as $p){
                                    echo '<tr>';
                                        echo '<td>' .$p['FECH'].'</td>';
                                        echo '<td> $' .number_format($p['TOTAL']).'</td>';
                                        echo '<td> $' .number_format($p['GAN']).'</td>';
                                        echo '<td> ' .$p['PRG'].'% </td>';
                                    echo '</tr>';
                                }
                            ?>                                    
                        </tbody>
                    </table>
                </div>            
            </div>
        </div>
    </div> 

    <!--MODAL PRODUCTO-->
    <div class="modal fade" id="modal_p">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalles de la venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="tabled" class="table table-default display">
                    <thead>
                        <tr>
                            <th>Codigo Producto</th>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Precio venta</th>
                            <th>Total</th>
                            <th>Categoria</th>
                        </tr>
                    </thead>
                    <tbody id="tbl_vent_">                                 
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <h2>Total facturado: <span id="tt"></span> </h2>
            </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/js/vendedor.js"></script>
</body>
</html>