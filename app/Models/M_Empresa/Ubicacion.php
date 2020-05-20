<?php

namespace App\Models\M_Empresa;

use Illuminate\Database\Eloquent\Model;
use App\Models\M_Empresa\Empresa;

class Ubicacion extends Model
{
    protected $table = 'ubicaciones';

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
