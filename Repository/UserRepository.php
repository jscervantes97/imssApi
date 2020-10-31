<?php
require_once 'Entity/User.php';
require_once 'Entity/MedicamentoEnReceta.php';
require_once 'Entity/RecetaMedica.php';
require_once 'Conexion/Conexion.php';

class UserRepository
{

    private $conexion ;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }

    public function findOne($id){
        $registro = $this->conexion->query("SELECT * FROM `usuarios` WHERE idUsuario = '{$id}'") or die ("Error en la query..");
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
            $usuario->setNss($reg[8]);
            $usuario->setIdClinica($reg[9]);
            $usuario->setDomicilio($reg[10]);
            return $usuario ;
        }
        else {
            return null ;
        }
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
            $usuario->setNss($reg[8]);
            $usuario->setIdClinica($reg[9]);
            $usuario->setDomicilio($reg[10]);
            return $usuario ;
        }
        else {
            return null ;
        }
    }

    public function obtenerRecetaMedica($idReceta,$idUsuario){
        $recetaMedica = new RecetaMedica();
        $registro = $this->conexion->query("SELECT * FROM `recetasmedicas` WHERE `idReceta` = {$idReceta} and `idUsuario` = {$idUsuario}") or die ("Error en la query..");
        if($reg = mysqli_fetch_array($registro)){
            $recetaMedica->setIdUsuario($reg[1]);
            $recetaMedica->setIdReceta($reg[0]);
            $recetaMedica->setFechaExpedicion($reg[2]);
            $recetaMedica->setStatus($reg[3]);
        }
        else {
            return null ;
        }
        $recetaMedica->setDesloceMedicamentos($this->obtenerDesgloseReceta($idReceta,$idUsuario));
        return $recetaMedica ;
    }

    public function obtenerDesgloseReceta($idReceta,$idUsuario){
        $medicamentos = array();
        $registro = $this->conexion->query("SELECT im.nombreMedicamento,rhm.cantidad, (select if(ivc.existenciaActual>0,'Disponible','No disponible') from inventarioclinica ivc WHERE ivc.idClinica = us.idClinica and ivc.idMedicamento = im.idMedicamento) as 'Disponible' FROM recetasmedicas rm inner join recetashasmedicamentos rhm on rm.idReceta = rhm.idReceta INNER join inventariomedicamento im on rhm.idMedicamento = im.idMedicamento inner join usuarios us on rm.idUsuario = us.idUsuario WHERE rm.idReceta = {$idReceta} and rm.idUsuario = {$idUsuario}") or die ("Error en la query..");
        if($registro->num_rows > 0){
            while($reg = mysqli_fetch_array($registro)){
                $medicamento = new MedicamentoEnReceta();
                $medicamento->setNombreMedicamento($reg[0]);
                $medicamento->setCantidad($reg[1]);
                $medicamento->setDisponible($reg[2]);
                array_push($medicamentos,$medicamento->toJson());
            }
            return $medicamentos;
        }
        else {
            return null ;
        }
    }

    public function guardarSolicitud(User $usuario){
        return $this->conexion->query("INSERT INTO solicitudnotificacion(idUsuario, fechaSolicitud, idClinica, status) VALUES ({$usuario->getIdUsuario()},curdate(),{$usuario->getIdClinica()},'ACTIVA')") ;
    }

    public function verificarSolicitudActiva($idUsuario){
        $registro = $this->conexion->query("SELECT * FROM solicitudnotificacion WHERE idUsuario = {$idUsuario} and status = 'ACTIVA' ;");
        return $registro->num_rows ;
    }

    public function verificarSolicitud($idUsuario,$estatus){
        $registro = $this->conexion->query("SELECT * FROM solicitudnotificacion WHERE idUsuario = {$idUsuario} and status = '{$estatus}}' ;");
        return $registro->num_rows ;
    }


}