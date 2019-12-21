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

$json = array();
$tables =  $database::select('show tables');
foreach ($tables as $t) {
    $nameTable = $t->Tables_in_rincon; //cambiar rincon por el nombre de su base de datos
    $nameClass= "";
    foreach (explode("_",$nameTable) as $w) { $nameClass.= ucwords($w); }
    $describe =  $database::select('describe '.$nameTable );
    $atributos = array(); 
    foreach ($describe as $columns) {
        $i = 0;
        $types = array(); 
        foreach ($columns as $nameColumn) {          
            array_push($types,$nameColumn);
        }
        array_push($atributos,$types);
    }    
    $n = array($nameClass => $atributos);
    array_push($json,$n);
    createModel($nameClass,$nameTable,$atributos[0]);
}

echo json_encode($json);

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

