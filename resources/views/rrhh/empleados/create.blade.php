@extends('layouts.adminlayout')
@section('content')

@section('icono')
  <i class="nav-icon fas fa-user-friends"></i>
@endsection

@section('vista', 'Crear Empleado')

@section('breadcrumb')  
  <li class="breadcrumb-item"><a href="{{route('empleados.index')}}">Empleados</a></li>
  <li class="breadcrumb-item active">Crear Empleado</li>
@endsection
<section class="content mb-4">
  <div class="card card-solid">
    <div class="card-body ">
      <crearempleado :cargos="{{json_encode($cargos)}}" />
    </div>
  </div>
</section>
@endsection