@extends('layouts.adminlayout')

@section('icono')
  <i class="far fa-check-square"></i>
@endsection

@section('vista', 'Crear permiso')

@section('breadcrumb')  
  <li class="breadcrumb-item active"><a href="{{route('permisos.index')}}">Permisos </a> </li>
  <li class="breadcrumb-item ">Crear Permiso</li>
@endsection

@section('content')

    <section>
      <crearpermiso :permisos="{{ json_encode($permisos) }}"/>
    </section>

@endsection