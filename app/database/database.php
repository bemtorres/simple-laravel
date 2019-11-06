<?php
use Illuminate\Database\Capsule\Manager as Database;

$database = new Database;

// configuracion
$database->addConnection([
    'driver'   => 'mysql',
    'host'     => 'localhost',
    'port'     => '3306',
    'database' => 'lindasonrisa',
    'username' => 'root',
    'password' => '',
    'charset'  => 'utf8',
    'collation'=> 'utf8_unicode_ci',
]);

// Base de datos de forma global
$database->setAsGlobal();
// Inicia base de datos
$database->bootEloquent();