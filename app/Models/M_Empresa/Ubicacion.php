<?php

namespace App\Models\M_Empresa;

use Illuminate\Database\Eloquent\Model;
use App\Models\M_Empresa\Empresa;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ubicacion extends Model
{

  use SoftDeletes;

  protected $table = 'ubicaciones';

  public function empresa()
  {
      return $this->belongsTo(Empresa::class);
  }
}
