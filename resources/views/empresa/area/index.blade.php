@extends('layouts.adminlayout')

@section('icono')
  <i class="fas fa-search-location"></i> 
@endsection

@section('vista', 'Áreas')

@section('breadcrumb')  
  <li class="breadcrumb-item active">Áreas</li>
@endsection

@section('content')

  <section class="content mb-4">
    <div class="card card-solid">
      <div class="card-body pt-1">
      <areas
      can_crear="{{ Auth::user()->can('permisos', 'Crear-areas') ? true : false }}"
      can_ver="{{ Auth::user()->can('permisos', 'Ver-areas') ? true : false }}"
      can_editar="{{ Auth::user()->can('permisos', 'Editar-areas') ? true : false }}"
      can_eliminar="{{ Auth::user()->can('permisos', 'Eliminar-areas') ? true : false }}"
      />
      </div>
    </div>
  </section>
    
@endsection
