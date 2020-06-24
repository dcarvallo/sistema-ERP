@extends('layouts.adminlayout')

{{-- @section('icono')
  <i class="far fa-handshakes">
@endsection --}}

@section('vista', 'Crear rol')

@section('breadcrumb')  
  <li class="breadcrumb-item active"><a href="{{route('roles.index')}}">Roles </a> </li>
  <li class="breadcrumb-item ">Crear Rol</li>
@endsection


@section('content')

    <section>
      <crearrol :permisos="{{ json_encode($permisos) }}" :categorias="{{json_encode($categorias)}}"/>
    </section>

@endsection