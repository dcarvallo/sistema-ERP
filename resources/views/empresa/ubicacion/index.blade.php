@extends('layouts.adminlayout')

@section('icono')
  <i class="fas fa-search-location"></i> 
@endsection

@section('vista', 'Ubicaciones')

@section('breadcrumb')  
  <li class="breadcrumb-item active">Ubicaciones</li>
@endsection

@section('content')

  <section>
    <ubicaciones
      can_crear="{{ Auth::user()->can('permisos', 'Crear-ubicaciones') ? true : false }}"
      can_ver="{{ Auth::user()->can('permisos', 'Ver-ubicaciones') ? true : false }}"
      can_editar="{{ Auth::user()->can('permisos', 'Editar-ubicaciones') ? true : false }}"
      can_eliminar="{{ Auth::user()->can('permisos', 'Eliminar-ubicaciones') ? true : false }}"
    />
  </section>
    
@endsection
