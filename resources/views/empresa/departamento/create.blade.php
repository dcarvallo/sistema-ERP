@extends('layouts.adminlayout')

@section('icono')
  <i class="fas fa-search-location"></i> 
@endsection

@section('vista', 'Crear Departamento')

@section('breadcrumb')  
  <li class="breadcrumb-item"><a href="{{route('departamentos.index')}}">Departamentos</a></li>
  <li class="breadcrumb-item active">Crear Departamento</li>
@endsection

@section('content')

  <section class="content mb-4">
    <creardepartamento :ubicaciones="{{json_encode($ubicaciones) }}" :cargos="{{json_encode($cargos)}}"/>
  </section>

@endsection

