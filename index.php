<?php 
    require_once 'vendor/autoload.php';
    require_once 'app/database/database.php';
    require_once 'app/Modelo/Usuario.php';

    $usuario = Usuario::get();

    d($usuario[0]->tipoEmpleado->nombre_tipo_empleado);

    
    