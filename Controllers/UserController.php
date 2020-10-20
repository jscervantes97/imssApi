<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: text/html; charset=utf-8');
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');

require '..\Entity\User.php';
require '..\Repository\UserRepository.php';

$userRepository = new UserRepository();
$opcion = $_GET['opc'] ;
switch ($opcion){
    case 1 :
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $usuario = $userRepository->iniciarSesion($data->correo ,$data->contra );
        if($usuario == null){
            http_response_code(404);
            echo json_encode(array('respuesta' => 'Usuario o contraseña incorrectos'));
        }else {
            http_response_code(200);
            //echo json_encode(array($usuario));
            echo json_encode($usuario->toJson());
        }
        break  ;
    case 2 :
        $correo = $_GET['correo'] ;
        $usuario = $userRepository->obtenerUsuarioPorCorreo($correo);
        if($usuario == null){
            http_response_code(404);
            echo json_encode(array('respuesta' => 'Usuario Inexistente'));
        }else {
            http_response_code(200);
            //echo json_encode(array($usuario));
            echo json_encode($usuario->toJson());
        }
        break  ;
}
