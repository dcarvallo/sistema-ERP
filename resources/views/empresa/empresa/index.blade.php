@extends('layouts.adminlayout')

@section('css-head')
  <link rel="stylesheet" href="css/css.css">
  <link rel="stylesheet" href="css/animate.min.css">
@endsection

@section('content')

  <div class="content-wrapper">
<div>

</div>
       <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Datos de Empresa</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            @if($empresa == null)
              @can('empresa.create')
                <li class="breadcrumb-item"><a class="btn btn-primary text-white" href="{{route('empresas.create')}}">Crear Empresa</a></li>
              @endcan
            @else
              @can('empresa.edit')
                <li class="breadcrumb-item"><a class="btn btn-warning text-darker" href="{{route('empresas.edit', [$empresa->id])}}" >Editar</a></li>
              @endcan
            @endif
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  @if($empresa != null)
    <section class="content" id="app">
        <!-- Default box -->
        <div class="card">
          <div class="card-body">
            <div class="card"> 
              <div class="card-body container-fluid text-center contentempresa row mx-0 py-4">
                  <div class="col-md-8 d-flex flex-column justify-content-center">
                    <h1 class="mb-4" id="nombre">{{$empresa->nombre}}</h1><br>
                    <p id="descripcion">{{$empresa->descripcion}}</p>
                  </div>
                  @if($empresa->imagen_empresa)
                  <div class="col-md-4 text-center my-3" >
                    <img src="{{ asset('storage/'.$empresa->imagen_empresa)}}" class="rounded img-fluid animate__animated animate__fadeIn animate__slower align-middle" style="max-height: 300px">
                  </div>
                  @endif
              </div>
            </div>
            <div class="card my-3">
              <div class="card-body">
              <div class="row">
              <div class="col-md-6">
                <div>
                  <p class="mb-0"> {{$empresa->rubro}}</p>
                  <hr class="my-0 border">
                  <p class="font-weight-bold">Rubro</p>
                </div>
                <br>
                <div >
                  <p class="mb-0">{{$empresa->mision}}</p>
                  <hr class="my-0 border">
                  <p class="font-weight-bold">Misión</p>
                </div>
                <br>
                <div >
                  <p class="mb-0">{{$empresa->vision}}</p>
                  <hr class="my-0 border">
                  <p class="font-weight-bold">Visión</p>
                </div>
              </div>
              <div class="col-md-6">
                <div>
                  <p  class="mb-0">{{$empresa->telefono}}</p>
                  <hr class="my-0 border">
                  <p class="font-weight-bold">Télefono</p>
                </div>
                <br>
                <div>
                  <p class="mb-0">Calle: {{$empresa->direccion}}</p>
                  <hr class="my-0 border">
                  <p class="font-weight-bold">Dirección</p>
                </div>
                <br>
                <div>
                  <p class="mb-0">{{$empresa->email}}</p>
                  <hr class="my-0 border">
                  <p class="font-weight-bold">Email</p>
                </div>
                <br>
                <div>
                  <p class="mb-0">{{$empresa->fecha_creacion}}</p>
                  <hr class="my-0 border">
                  <p class="font-weight-bold">Fecha de Creación</p>
                </div>
                
              </div>
              </div>
              </div>
            </div>
            
          </div>

      </div>
      </section>
      @endif
      {{-- @include('sweetalert::alert') --}}

  </div>

@endsection

@section('js-footer')
@if(Session::has('message'))
<script>
  var variable = '{{ Session::get('message') }}';
    toast.fire({
      icon: 'success',
      title: variable
    });
  </script>
  @endif
@endsection