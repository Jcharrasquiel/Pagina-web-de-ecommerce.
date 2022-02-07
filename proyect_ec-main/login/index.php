<?php
include '../controladores/AuthController.php';
$controller = new AuthController();
$rol = $controller->getSession();
if($rol){
    if($rol['rol'] == 1){
        echo "<script language=\"javascript\">
            window.location.href=\"../administrador/index.php\";
            </script>";
    }else if($rol['rol'] == 2){
        echo "<script language=\"javascript\">
            window.location.href=\"../vendedor/index.php\";
            </script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link rel="stylesheet" href="../assets/css/bootstrap/bootstrap.min.css">
    <title>Iniciar Sesión</title>
</head>
<body>
    <div class=" modal-body modal-dialog">
        <div class=" container col-lg-11">
            <div class="modal-content col-lg-9">         
                <form id="frm_login" name="frm_login" class="text-center" action="../service/serviceAuth.php" method="post"><br>
                    <img src="../assets/img/icon-sesion.png" width="150px" height="150px"> 
                    <br>
                    <br>
                    <div class="form-group">                      
                      <input type="text" class="form-control" id="txtUser" placeholder="Nombre Usuario" name="txtUser" autofocus reuired>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" id="txtPass" placeholder="Contraseña" name="txtPass" reuired>
                    </div>
                    <button type="submit" class="btn btn-danger" >Ingresar</button>
                    <br>
                  </form><br>
            </div>
        </div>
    </div>

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="../assets/js/login.js"></script>
</body>
</html>