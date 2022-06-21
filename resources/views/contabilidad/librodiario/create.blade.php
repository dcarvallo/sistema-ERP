@extends('layouts.adminlayout')

{{-- @section('icono')
  <i class="far fa-handshakes">
@endsection --}}

@section('vista', 'Crear libro diario')

@section('breadcrumb')  
  <li class="breadcrumb-item active"><a href="{{route('librodiarios.index')}}">Roles </a> </li>
  <li class="breadcrumb-item ">Crear Rol</li>
@endsection


@section('content')

    <section>
      <crearlibrodiario :cuentas="{{ json_encode($cuentas) }}"/>
    </section>

@endsection