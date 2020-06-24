<?php

namespace App\Models\M_RRHH;

use App\Models\M_Empresa\Cargo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleado extends Model
{
  use SoftDeletes;
  
  public function cargo()
  {
      return $this->belongsTo(Cargo::class);
  }
}
