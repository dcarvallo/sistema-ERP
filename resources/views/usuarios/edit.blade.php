@extends('layouts.adminlayout')
@section('css-head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')

       <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Usuarios</h1>
        </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('users.index')}}">Usuarios</a></li>
              <li class="breadcrumb-item active">Editar Usuario</li>
            </ol>
          </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
    <section class="content mb-4" id="app">
      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body ">
        {{-- {{dd($usuario->roles->toArray())}} --}}
        
        <editarusuario :usuario="{{$usuario}}" :rolesusuario="{{ $usuario->roles }}" :roles="{{$roles}}" />
          
        </div>
      </div>
    </section>

@endsection