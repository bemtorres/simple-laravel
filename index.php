<?php 
    require_once 'vendor/autoload.php';
    require_once 'app/database/database.php';
    require_once 'app/modelo/Usuario.php';

    $usuario = Usuario::get();

    d($usuario[0]->tipoEmpleado->nombre_tipo_empleado);

    
    