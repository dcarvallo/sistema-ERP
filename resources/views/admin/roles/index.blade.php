@extends('layouts.adminlayout')

@section('icono')
  <i class="fas fa-user-tag"></i>
@endsection

@section('vista', 'Roles')

@section('breadcrumb')  
  <li class="breadcrumb-item active">Roles</li>
@endsection

@section('content')

<section class="content mb-4">
  <div class="card card-solid">
    <div class="card-body pt-1">

      <roles
        can_crear="{{ Auth::user()->can('permisos', 'Crear-roles') ? true : false }}"
        can_ver="{{ Auth::user()->can('permisos', 'Ver-roles') ? true : false }}"
        can_editar="{{ Auth::user()->can('permisos', 'Editar-roles') ? true : false }}"
        can_eliminar="{{ Auth::user()->can('permisos', 'Eliminar-roles') ? true : false }}"
      >
    </roles>

    </div>
  </div>
</section>

@endsection