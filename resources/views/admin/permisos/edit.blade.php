@extends('layouts.adminlayout')

@section('icono')
  <i class="far fa-check-square"></i>
@endsection

@section('vista', 'Editar permiso')

@section('breadcrumb')  
  <li class="breadcrumb-item active"><a href="{{route('permisos.index')}}">Permisos </a> </li>
  <li class="breadcrumb-item ">Editar Permiso</li>
@endsection


@section('content')

    <section>
    <editarpermiso :permiso=" {{$permiso}} "/>
    </section>

@endsection