@extends('layouts.adminlayout')
@section('content')

@section('icono')
  <i class="nav-icon fas fa-user-friends"></i>
@endsection

@section('vista', 'Empleados')

@section('breadcrumb')  
  <li class="breadcrumb-item active">Empleados</li>
@endsection

<section class="content mb-4">
  <div class="card card-solid">
    <div class="card-body pt-1">
      
      <empleados 
        can_crear="{{ Auth::user()->can('permisos','Crear-empleados') ? true : false }}"
        can_ver="{{ Auth::user()->can('permisos','Ver-empleados') ? true : false }}"
        can_editar="{{ Auth::user()->can('permisos','Editar-empleados') ? true : false }}"
        can_eliminar="{{ Auth::user()->can('permisos','Eliminar-empleados') ? true : false }}"
      />
 
    </div>
  </div>
</section>

@endsection