@extends('layouts.adminlayout')

@section('icono')
  <i class="fas fa-search-location"></i> 
@endsection

@section('vista', 'Crear Área')

@section('breadcrumb')  
  <li class="breadcrumb-item"><a href="{{route('areas.index')}}">Áreas</a></li>
  <li class="breadcrumb-item active">Crear Área</li>
@endsection

@section('content')

    <section class="content mb-4">
      <creararea :departamentos="{{json_encode($departamentos) }}" :cargos="{{json_encode($cargos)}}"/>
    </section>

@endsection

