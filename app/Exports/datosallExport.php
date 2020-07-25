<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class datosallExport implements FromQuery, WithHeadings
{
  use Exportable;

  public function headings(): array
    {
      return [
        'ID',
        'Nombre completo',
        'Nombres',
        'Apellidos',
        'Nombre de usuario',
        'Email',
        'Activo',
        'Fotografia',
        'P',
        'Borrado',
        'Creado',
        'Editado',
      ];
    }

  public function query()
  {
      return User::query();
  }
}
