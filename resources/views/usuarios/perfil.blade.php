@extends('layouts.adminlayout')

@section('icono')
  <i class="far fa-id-badge"></i>
@endsection

@section('vista', 'Perfil')

@section('breadcrumb')  
  <li class="breadcrumb-item"><a href="home">Inicio</a></li>
  <li class="breadcrumb-item active">Perfil de Usuario</li>
@endsection

@if(Session::has('resetpass'))
  <div class="d-flex justify-content-end">
    <div class="rounded alert-success col-md-3">
      <p class="lead">
        {{Session::get('resetpass')}}
      </p>
    </div>
  </div>
@endif
@section('content')

  <section class="content">
    <div class="container-fluid">
      
    <perfil :usuario="{{$usuario}}"/>
    
    </div>
  </section>

@endsection