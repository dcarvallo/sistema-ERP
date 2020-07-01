@extends('layouts.adminlayout')
@section('content')

@section('icono')
  <i class="nav-icon fas fa-receipt"></i>
@endsection

@section('vista', 'Libro Diario')

@section('breadcrumb')  
  <li class="breadcrumb-item active">Libro Diario</li>
@endsection

<section class="content mb-4">
  <div class="card card-solid">
    <div class="card-body pt-1">
      
      <librodiario 
        can_crear="{{ Auth::user()->can('permisos','Crear-librodiarios') ? true : false }}"
        can_ver="{{ Auth::user()->can('permisos','Ver-librodiario') ? true : false }}"
        can_editar="{{ Auth::user()->can('permisos','Editar-librodiario') ? true : false }}"
        can_eliminar="{{ Auth::user()->can('permisos','Eliminar-librodiario') ? true : false }}"
      />
 
    </div>
  </div>
</section>

@endsection