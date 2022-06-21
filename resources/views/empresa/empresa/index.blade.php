@extends('layouts.adminlayout')

@section('css-head')
  <link rel="stylesheet" href="css/css.css">
  <link rel="stylesheet" href="css/animate.min.css">
@endsection

@section('icono')
  <i class="far fa-building"></i>
@endsection

@section('vista', 'Empresa')

@section('breadcrumb')  
  @if($empresa == null)
    @can('permisos', 'Crear-empresas')
      <li class="breadcrumb-item"><a class="btn btn-primary text-white" href="{{route('empresas.create')}}">Crear Empresa</a></li>
    @endcan
  @else
    {{-- @can('Editar-empresas') --}}
    @can('permisos', 'Editar-empresas')
      <li class="breadcrumb-item"><a class="btn btn-warning text-darker" href="{{route('empresas.edit', [$empresa->id])}}" >Editar</a></li>
    @endcan
  @endif
@endsection

@section('content')

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
                    <img src="{{ secure_asset('storage/'.$empresa->imagen_empresa)}}" class="rounded img-fluid animate__animated animate__fadeIn animate__slower align-middle" style="max-height: 300px">
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
                <div>
                  <p class="mb-0"> {{$empresa->nit}}</p>
                  <hr class="my-0 border">
                  <p class="font-weight-bold">NIT</p>
                </div>
                <br>
                <div>
                  <p class="mb-0"> {{$empresa->propietario}}</p>
                  <hr class="my-0 border">
                  <p class="font-weight-bold">propietario</p>
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