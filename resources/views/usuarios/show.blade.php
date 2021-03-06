@extends('layouts.adminlayout')
@section('css-head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('icono')
  <i class="fas fa-users"></i>
@endsection

@section('vista', 'Ver usuario')

@section('breadcrumb')  
  <li class="breadcrumb-item"><a href="{{route('users.index')}}">Usuarios</a></li>
  <li class="breadcrumb-item active">Ver Usuario</li>
@endsection

@section('content')

  <section class="content mb-4">
    <div class="card card-solid">
      <div class="card-body ">
        <mostrarusuario :usuario="{{$usuario}}" :rolesusuario="{{ $usuario->roles }}" :roles="{{json_encode($roles)}}" />
      </div>
    </div>
  </section>

@endsection