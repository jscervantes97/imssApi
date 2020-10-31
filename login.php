<?php
session_start();
require 'Conexion/Conexion.php';
$bd = new Conexion();
$usuarioNo = "" ;
if(isset($_POST['cajaUsuario']) && isset($_POST['cajaContra'])){
    $registros = $bd->query("select * from administradores where correo = '{$_POST['cajaUsuario']}'") or die ($bd->error);
    if($reg = mysqli_fetch_array($registros)){
        if($reg[5] == $_POST['cajaContra']){
            $_SESSION['logeado'] = "si"  ;
            $_SESSION['usuario']  = $_POST['cajaUsuario'] ;
        }
        else {
            $usuarioNo = "Contraseña incorrecta"  ;
        }
    }else {
        $usuarioNo = "No existe un usuario con ese correo" ;
    }
}
$bd->close();
if(isset($_SESSION['usuario']) && isset($_SESSION['logeado'])){
    if($_SESSION['logeado'] == "si"){
        header('Location: index.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php
require_once 'BodyParts/Head.php';
?>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center text-center align-items-center ">

        <div class="col-xl-6">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->

                    <div class="col-lg-12 text-center">
                        <div class="p-5">
                            <form method="post" action=login.php>
                                <h1 class="h3 mb-3 font-weight-normal">Iniciar Sesion</h1>
                                <label for="inputEmail">Usuario</label>
                                <input type="text" value="" name="cajaUsuario" class="form-control form-control-user" required autofocus>
                                <br>
                                <label for="inputPassword">Contraseña</label>
                                <input type="password" name="cajaContra" class="form-control" required>

                                    <div class="checkbox mb-3">
                                        <label>
                                            <input type="checkbox" name="_remember_me"> Remember me
                                        </label>
                                    </div>
                                
                                <br>
                                <input type="submit" class="btn btn-lg btn-primary" value="Iniciar Sesion">
                                    
                                <br>
                                <div class="text-center">
                                    <a class="small" href="forgot-password.html">Olvidaste tu contraseña?</a>
                                </div>
                            </form>
                            <?php
                            if($usuarioNo != ""){
                                ?>
                                <div class="alert alert-warning" role="alert" style="margin-top: 10px">
                                    <?php echo $usuarioNo ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

  </div>
</body>
</html>
