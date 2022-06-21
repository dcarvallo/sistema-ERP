@extends('layouts.adminlayout')

@section('icono')
  <i class="fas fa-search-location"></i> 
@endsection

@section('vista', 'Departamentos')

@section('breadcrumb')  
  <li class="breadcrumb-item active">Departamentos</li>
@endsection

@section('content')

  <section class="content mb-4">
    <div class="card card-solid">
      <div class="card-body pt-1">
        <departamentos
          can_crear="{{ Auth::user()->can('Crear-departamentos') ? true : false }}"
          can_ver="{{ Auth::user()->can('Ver-departamentos') ? true : false }}"
          can_editar="{{ Auth::user()->can('permisos', 'Editar-departamentos') ? true : false }}"
          can_eliminar="{{ Auth::user()->can('permisos', 'Eliminar-departamentos') ? true : false }}"
        />
      </div>
    </div>
  </section>
    
@endsection
