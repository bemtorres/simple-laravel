<?php

/*
|--------------------------------------------------------------------------
| Reflect 2019
|--------------------------------------------------------------------------
|
| Se genera el model a partir de la base de datos
|
*/

require_once './vendor/autoload.php';
require_once './app/Database/Database.php';

$json=array();
$tables=$database::select('show tables');
foreach ($tables as $t) {
    $nameTable=$t->Tables_in_rincon; //cambiar rincon por el nombre de su base de datos
    $nameClass="";
    foreach (explode("_",$nameTable) as $w) { $nameClass.= ucwords($w); }
    $describe =  $database::select('describe '.$nameTable);
    $atributos = array(); 
    foreach ($describe as $columns) {
        $i = 0;
        $types = array(); 
        foreach ($columns as $nameColumn) {          
            array_push($types,$nameColumn);
        }
        array_push($atributos,$types);
    }    
    array_push($json, array($nameClass => $atributos));
    createModel($nameClass,$nameTable,$atributos[0]);
}

// echo json_encode($json);



// buscar($json);

// function buscar($json = array()){
//     foreach ($json as $d) { //Arreglo principal
//         foreach ($d as $key => $value) { //nombre
//             echo "<strong>$key</strong> <br>";
//             foreach ($value as $c => $v) {
//                 echo "$v[0] " . buscarFK($json,$key,$v[0]) . "<br>";
//                 break;
//                 // print_r($v);
//             }
//             echo "<br>";
//         }
//     }
// }
// function buscarFK($json = array() ,$n, $id){
//     foreach ($json as $d) { //Arreglo principal
//         foreach ($d as $key => $value) { //nombre    
//             if($n!=$key)        
//             foreach ($value as $c => $v) {
//                 if($v[0]==$id){
//                     return $key . " ";
//                 }
//                 // echo "$v[0] <br>";
//                 // print_r($v);
//             }
//         }
//     }
// }

//Crear Modelo
function createModel($nameClass,$table,$primaryKey=array()){
    $_dir = "./app/Modelo";
    // <?php

    // use Illuminate\Database\Eloquent\Model;

    // class TipoEmpleado extends Model{
    //     protected $table = 'tipo_empleado';        
    //     protected $primaryKey = 'id_tipo_empleado';
        
    //     public $incrementing = false;
    //     public $timestamps = false;
    //     public function tipoEmpleado(){
    //          return $this->belongsTo(TipoEmpleado::class,'id_tipo_empleado');
    //      }
    // }   
    $isIncrementing="false";
    foreach ($primaryKey as $v) { if($v=="auto_increment"){ $isIncrementing="true";}}
    $file = fopen("$_dir/$nameClass.php", "w");
    $tab = "\t";
    $txt = "<?php \n\n";
    $txt .= "use Illuminate\Database\Eloquent\Model;\n\n"; 
    $txt .= "class $nameClass extends Model{\n\n";
    $txt .= $tab."protected \$table = '$table';\n";
    $txt .= $tab."protected \$primaryKey = '$primaryKey[0]';\n\n";    
    $txt .= $tab."protected \$incrementing = '$isIncrementing';\n\n";
    $txt .= "}"; 
    fwrite($file, $txt);
    fclose($file);
}

