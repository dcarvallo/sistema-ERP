@extends('layouts.adminlayout')
@section('css-head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('icono')
<i class="nav-icon fas fa-user-friends"></i>
@endsection

@section('vista', 'Ver empleado')

@section('breadcrumb')  
  <li class="breadcrumb-item"><a href="{{route('empleados.index')}}">Empleados</a></li>
  <li class="breadcrumb-item active">Ver Empleado</li>
@endsection

@section('content')

  <section class="content mb-4">
    <div class="card card-solid">
      <div class="card-body ">
        <mostrarempleado :empleado="{{$empleado}}" />
      </div>
    </div>
  </section>

@endsection