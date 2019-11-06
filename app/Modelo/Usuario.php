<?php

use Illuminate\Database\Eloquent\Model;

require_once 'TipoEmpleado.php';

class Usuario extends Model{
    protected $table = 'empleado';
        
    protected $primaryKey = 'id_empleado';

    public function tipoEmpleado(){
        return $this->belongsTo(TipoEmpleado::class,'id_tipo_empleado');
    }
}