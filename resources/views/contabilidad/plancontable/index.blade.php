@extends('layouts.adminlayout')
@section('content')

@section('icono')
  <i class="nav-icon fas fa-receipt"></i>
@endsection

@section('vista', 'Plan Contable Empresarial General')

@section('breadcrumb')  
  <li class="breadcrumb-item active">Plan Contable</li>
@endsection

<section class="content mb-4">
  <div class="card card-solid">
    <div class="card-body pt-1">
      
      <plancontable 
        can_crear="{{ Auth::user()->can('permisos','Crear-plancontable') ? true : false }}"
        can_ver="{{ Auth::user()->can('permisos','Ver-plancontable') ? true : false }}"
        can_editar="{{ Auth::user()->can('permisos','Editar-plancontable') ? true : false }}"
        can_eliminar="{{ Auth::user()->can('permisos','Eliminar-plancontable') ? true : false }}"
      />
 
    </div>
  </div>
</section>

@endsection