<?php 
    require_once '../vendor/autoload.php';
    require_once 'Database/Database.php';

    $usuarios = $database::table('empleado')->get();

    d($usuarios);


    require_once '../vendor/autoload.php';
    require_once 'Database/Database.php';
    require_once 'Modelo/Usuario.php';


    $usuarios = Usuario::get();

    d($usuarios);

    // var_dump($usuarios);
    
    