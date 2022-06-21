@extends('layouts.adminlayout')
@section('content')

@section('icono')
  <i class="nav-icon fas fa-user-friends"></i>
@endsection

@section('vista', 'Editar Empleado')

@section('breadcrumb')  
  <li class="breadcrumb-item"><a href="{{route('empleados.index')}}">Empleados</a></li>
  <li class="breadcrumb-item active">Editar Empleado</li>
@endsection
<section class="content mb-4">
  <div class="card card-solid">
    <div class="card-body ">
      <editarempleado :cargos="{{json_encode($cargos)}}" :empleado="{{$empleado}}"/>
    </div>
  </div>
</section>
@endsection