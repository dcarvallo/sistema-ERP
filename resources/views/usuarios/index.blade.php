@extends('layouts.adminlayout')

@section('icono')
  <i class="fas fa-users"></i>
@endsection

@section('vista', 'Usuarios')

@section('breadcrumb')  
  <li class="breadcrumb-item active">Usuarios /</li>
@endsection

@section('content')

  <section class="content mb-4">
    <div class="card card-solid">
      <div class="card-body pt-1">
        
        <usuarios 
          can_crear="{{ Auth::user()->can('permisos','Crear-usuarios') ? true : false }}"
          can_ver="{{ Auth::user()->can('permisos','Ver-usuarios') ? true : false }}"
          can_editar="{{ Auth::user()->can('permisos','Editar-usuarios') ? true : false }}"
          can_eliminar="{{ Auth::user()->can('permisos','Eliminar-usuarios') ? true : false }}"
          />
   
      </div>
    </div>
  </section>
  
@endsection