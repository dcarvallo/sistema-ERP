<?php

namespace App\Models\M_Empresa;
use App\Models\M_Empresa\Ubicacion;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    public function ubicaciones()
    {
        return $this->hasMany(Ubicacion::class);
    }
}