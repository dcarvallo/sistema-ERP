@extends('layouts.adminlayout')

@section('css-head')
  <link rel="stylesheet" href="css/css.css">
  <link rel="stylesheet" href="css/animate.min.css">
@endsection

@section('content')

  <div class="content-wrapper">

       <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Datos de Empresa</h1>
        </div>
        @can('empresa.create')
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              @if($empresa == null)
              <li class="breadcrumb-item"><a class="btn btn-primary text-white" href="{{route('empresas.create')}}">Crear Empresa</a></li>
              @else
              <li class="breadcrumb-item"><a class="btn btn-warning text-secondary" >Editar</a></li>
              @endif
            </ol>
          </div>
        @endcan
      </div>
    </div><!-- /.container-fluid -->
  </section>
  @if($empresa != null)
    <section class="content" id="app">
        <!-- Default box -->
        <div class="row d-flex justify-content-lg-center">
          <div class="col-md-12">
        <div class="card  card-solid">
          <div class="card-body">
            <div class="texto text-center contentempresa row">
              <div class="col-md-8 d-flex flex-column justify-content-center">
                <h1 class="mb-4" id="nombre">{{$empresa->nombre}}</h1><br>
                <p id="descripcion">{{$empresa->descripcion}}</p>
              </div>
              <div class="col-md-4 text-center my-3">
                <img src="/img/logo.png"  class="img img-fluid animate__animated animate__fadeInDownBig align-middle" alt="">
              </div>
            </div>
            <div class="card my-3">
              <div class="card-body">
              <div class="row">
              <div class="col-md-6">
                <div>
                  <h4 class="bold">Rubro</h4>
                  <p>{{$empresa->rubro}}</p>
                </div>
                <hr>
                <div >
                  <h4 class="bold">Mision</h4>
                  <p >{{$empresa->mision}}</p>
                </div>
                <hr>
                <div >
                  <h4 class="bold">Vision</h4>
                  <p >{{$empresa->vision}}</p>
                </div>
              </div>
              <div class="col-md-6">
                <div>
                  <h4 class="bold">Telefono</h4>
                  <p>{{$empresa->telefono}}</p>
                </div>
                <hr>
                <div>
                  <h4 class="bold">Direccion</h4>
                  <p>Calle: {{$empresa->direccion}}</p>
                </div>
                <hr>
                <div>
                  <h4 class="bold">Email</h4>
                  <p>{{$empresa->email}}</p>
                </div>
                <hr>
                <div>
                  <h4 class="bold">Fecha de Creación</h4>
                  <p>{{$empresa->fecha_creacion}}</p>
                </div>
                
              </div>
              </div>
              </div>
            </div>
            
          </div>

          </div>
        </div>
      </div>
      </section>
      @endif

  </div>

@endsection