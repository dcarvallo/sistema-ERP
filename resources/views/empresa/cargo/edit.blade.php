@extends('layouts.adminlayout')

@section('icono')
  <i class="fas fa-user-tie"></i>
@endsection

@section('vista', 'Editar Cargo')

@section('breadcrumb')  
  <li class="breadcrumb-item"><a href="{{route('cargos.index')}}">Cargos</a></li>
  <li class="breadcrumb-item active">Editar Cargo</li>
@endsection

@section('content')

  <section class="content mb-4" id="app">
    <!-- Default box -->
      <editarcargo :cargo="{{$cargo}}" :areas="{{json_encode($areas) }}" />
  </section>

@endsection
