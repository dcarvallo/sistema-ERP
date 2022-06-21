<?php

namespace App\Http\Controllers\C_Contabilidad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportescontablesController extends Controller
{
    public function index()
    {
      return view('contabilidad.reportes.index');
    }
}
