@extends('layouts.adminlayout')
@section('content')

@section('icono')
  <i class="nav-icon fas fa-user-friends"></i>
@endsection

@section('vista', 'Editar Empleado')

@section('breadcrumb')  
  <li class="breadcrumb-item active">RRHH</li>
@endsection

  <empleadoedit :usuario="{{ json_encode($usuario) }}"></empleadoedit>

@endsection