<?php 
    require_once '../vendor/autoload.php';
    require_once 'database/database.php';

    $usuarios = $database::table('centro')->get();

    d($usuarios);

    // var_dump($usuarios);
    
    