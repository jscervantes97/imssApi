<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: X-Requested-With");
//header('Content-Type: text/html; charset=utf-8');
header('Content-Type: application/json');
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');

require_once './Repository/UserRepository.php';

$userRepository = new UserRepository();
$metodo = $_SERVER["REQUEST_METHOD"];
//Desarrollo
$ruta = implode("/", array_slice(explode("/", $_SERVER["REQUEST_URI"]), 3));
//Produccion -> no se porque carambas funciona en desarrollo con 3 y en produccion con 2
//$ruta = implode("/", array_slice(explode("/", $_SERVER["REQUEST_URI"]), 2));
$datos = json_decode(file_get_contents("php://input"));
//echo $ruta.'<br>' ;
//$rutaGet = implode("/",array_slice(explode("/",$ruta),0));
switch($metodo){
    case 'GET':
        $rutaGet = explode("/",$ruta);
        switch ($rutaGet[0]) {
            case 'Verificar':
                // $rutaGet[1] es el parametro que viene  ;
                $usuario = $userRepository->findOne($rutaGet[1]);
                if($usuario == null){
                    http_response_code(404);
                    echo json_encode(array('respuesta' => 'No existe ningun usuario con esa ID'));
                    return;
                }
                if($userRepository->verificarSolicitudActiva($rutaGet[1]) > 0){
                    http_response_code(200);
                    echo json_encode(array('respuesta' => 'Tu solicitud aun esta en espera de ser autorizada cuando esta sea autorizada se te mostrara en este apartado'));
                }else if($userRepository->verificarSolicitud($rutaGet[1],"AUTORIZADA") > 0){
                    http_response_code(200);
                    echo json_encode(array('respuesta' => 'Tu solicitud aun esta en espera de ser autorizada cuando esta sea autorizada se te mostrara en este apartado'));
                }
                else{
                    http_response_code(200);
                    echo json_encode(array('respuesta' => 'El usuario no tiene solicitudes'));
                }
                break;

        }
        break;
    case 'POST':
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        switch ($ruta) {
            case 'login':
                $usuario = $userRepository->iniciarSesion($data->correo ,$data->contra );
                if($usuario == null){
                    http_response_code(404);
                    echo json_encode(array('respuesta' => 'Usuario o contraseña incorrectos'));
                }else {
                    http_response_code(200);
                    echo json_encode($usuario->toJson());
                }
                break;
            case 'recetaMedica':
                $receta = $userRepository->obtenerRecetaMedica($data->idReceta,$data->idUsuario);
                if($receta == null){
                    http_response_code(404);
                    echo json_encode(array('respuesta' => 'Receta Invalida o el usuario actual no corresponde a esa receta'));
                }else {
                    http_response_code(200);
                    //echo json_encode(array($usuario));
                    echo json_encode($receta->toJson());
                }
                break;
            case 'agendarSolicitud':
                $usuario = $userRepository->findOne($data->idUsuario);
                if($usuario == null){
                    http_response_code(404);
                    echo json_encode(array('respuesta' => 'No existe ningun usuario con esa ID'));
                    return;
                }
                if($userRepository->verificarSolicitudActiva($usuario->getIdUsuario()) > 0){
                    http_response_code(200);
                    echo json_encode(array('respuesta' => 'Ya realizaste tu solicitud, favor de esperar a que la autoricen'));
                    return ;
                }
                if($userRepository->guardarSolicitud($usuario)){
                    http_response_code(200);
                    echo json_encode(array('respuesta' => 'Solicitud realizada con exito...'));
                }else {
                    http_response_code(500);
                    echo json_encode(array('respuesta' => 'Ocurrio un error'));
                }
                break ;
        }
        break;
}
