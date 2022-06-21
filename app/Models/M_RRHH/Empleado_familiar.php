<?php

namespace App\Models\M_RRHH;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleado_familiar extends Model
{

  use SoftDeletes;

  protected $table = 'empleado_familiares';
}
