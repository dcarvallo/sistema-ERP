@extends('layouts.adminlayout')

@section('icono')
  <i class="fas fa-user-tie"></i>
@endsection

@section('vista', 'Cargos')

@section('breadcrumb')  
  <li class="breadcrumb-item active">Cargos</li>
@endsection

@section('content')

  <section class="content mb-4">
    <div class="card card-solid">
      <div class="card-body pt-1">
        <cargos
          can_crear="{{ Auth::user()->can('permisos', 'Crear-cargos') ? true : false }}"
          can_ver="{{ Auth::user()->can('permisos', 'Ver-cargos') ? true : false }}"
          can_editar="{{ Auth::user()->can('permisos', 'Editar-cargos') ? true : false }}"
          can_eliminar="{{ Auth::user()->can('permisos', 'Eliminar-cargos') ? true : false }}"
        />
      </div>
    </div>
  </section>
    
@endsection
