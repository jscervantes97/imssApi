<?php
require_once '..\Entity\User.php';
require_once '..\Conexion\Conexion.php';

class UserRepository
{

    private $conexion ;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }

    public function iniciarSesion($correo, $pass){
        $registro = $this->conexion->query("SELECT * FROM `usuarios` WHERE correo = '{$correo}' and contra ='{$pass}'") or die ("Error en la query..");
        if($reg = mysqli_fetch_array($registro)){
            $usuario = new User();
            $usuario->setIdUsuario($reg[0]);
            $usuario->setNombres($reg[1]);
            $usuario->setApellidoPaterno($reg[2]);
            $usuario->setApellidoMaterno($reg[3]);
            $usuario->setCorreo($reg[4]);
            $usuario->setNumeroCelular($reg[5]);
            $usuario->setAccessToken($reg[7]);
            $usuario->setNss($reg[8]);
            $usuario->setIdClinica($reg[9]);
            $usuario->setDomicilio($reg[10]);
            return $usuario ;
        }
        else {
            return null ;
        }
    }

    public function obtenerUsuarioPorCorreo($correo){
        $registro = $this->conexion->query("SELECT * FROM `usuarios` WHERE correo = '{$correo}'") or die ("Error en la query..");
        if($reg = mysqli_fetch_array($registro)){
            $usuario = new User();
            $usuario->setIdUsuario($reg[0]);
            $usuario->setNombres($reg[1]);
            $usuario->setApellidoPaterno($reg[2]);
            $usuario->setApellidoMaterno($reg[3]);
            $usuario->setCorreo($reg[4]);
            $usuario->setNumeroCelular($reg[5]);
            $usuario->setContra($reg[6]);
            $usuario->setAccessToken($reg[7]);
            return $usuario ;
        }
        else {
            return null ;
        }
    }

}