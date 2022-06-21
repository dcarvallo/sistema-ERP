@extends('layouts.adminlayout')

@section('icono')
  <i class="fas fa-search-location"></i> 
@endsection

@section('vista', 'Editar Departamento')

@section('breadcrumb')  
  <li class="breadcrumb-item"><a href="{{route('departamentos.index')}}">Departamentos</a></li>
  <li class="breadcrumb-item active">Editar Departamento</li>
@endsection

@section('content')

  <section class="content mb-4" id="app">
    <!-- Default box -->
      <editardepartamento :departamento="{{$departamento}}" :ubicaciones="{{json_encode($ubicaciones) }}" :cargos="{{json_encode($cargos)}}"/>
  </section>

@endsection
