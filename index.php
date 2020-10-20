<?php
require_once 'Entity\User.php';
require_once 'Repository\UserRepository.php';

$userRepository = new UserRepository();
$usuario = $userRepository->obtenerUsuarioPorCorreo('jscervantesmedina@gmail.om');
if($usuario == null){
    echo 'no existe un usuario con ese correo' ;
}
