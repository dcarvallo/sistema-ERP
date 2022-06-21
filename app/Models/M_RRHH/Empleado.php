<?php

namespace App\Models\M_RRHH;

use App\Models\M_Empresa\Cargo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleado extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'id',
    'empleado_id', 
    'nombres', 
    'ap_paterno', 
    'ap_materno', 
    'nacionalidad', 
    'ci', 
    'lugar_exp',
    'direccion',
    'fecha_nac',
    'lugar_nac',
    'sexo',
    'estado_civil',
    'telefono',
    'email',
    'religion',
    'altura',
    'peso',
    'tipo_sangre',
    'fotografia',
    'fecha_contrato',
    'tipo_contrato',
    'cargo_id'
  ];
  
  public function cargo()
  {
      return $this->belongsTo(Cargo::class);
  }
}
