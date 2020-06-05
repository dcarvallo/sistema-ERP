@extends('layouts.adminlayout')

{{-- @section('icono')
  <i class="far fa-handshakes">
@endsection --}}

@section('vista', 'Editar rol')

@section('breadcrumb')  
  <li class="breadcrumb-item active"><a href="{{route('roles.index')}}">Roles </a> </li>
  <li class="breadcrumb-item ">Editar Rol</li>
@endsection

@section('content')

    <section>
    <editarrol :rol="{{ $rol }}" :permisos=" {{json_encode($permisos)}} " :permisosseleccionados="{{$rol->permissions}}"/>
    </section>

@endsection