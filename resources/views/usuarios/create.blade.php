@extends('layouts.adminlayout')

@section('icono')
  <i class="fas fa-users"></i>
@endsection

@section('vista', 'Crear usuario')

@section('breadcrumb')  
  <li class="breadcrumb-item"><a href="{{route('users.index')}}">Usuarios</a></li>
  <li class="breadcrumb-item active">Crear Usuario</li>
@endsection

@section('content')

  <section class="content mb-4">
    <div class="card card-solid">
      <div class="card-body ">
    
      <crearusuario :roles="{{$roles}}" :empleados="{{$empleados}}"/>
    
      </div>
    </div>
  </section>

@endsection