@extends('layouts.adminlayout')

@section('icono')
  <i class="fas fa-search-location"></i> 
@endsection

@section('vista', 'Ver Ubicación')

@section('breadcrumb')  
  <li class="breadcrumb-item"><a href="{{route('ubicaciones.index')}}">Ubicaciones</a></li>
  <li class="breadcrumb-item active">Mostrar Ubicación</li>
@endsection

@section('content')

  <section class="content mb-4">
    
    <div class="card card-solid">
      <div class="card-body ">
    
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                  <h5>Información de Ubicación</h5>
              </div>
            <div class="card-body">
              <div>
                <p class="mb-0">{{$ubicacion->nombre}}</p>
                <hr class="my-0">
                <label><strong>Nombre</strong> </label>
              </div>
              <br>
              <div>
                <p class="mb-0">{{$ubicacion->descripcion}}</p>
                <hr class="my-0">
                <label class="" for="nombre">Descripción</label>
              </div>
              <br>
              <div>
                <p class="mb-0">{{$ubicacion->locacion}}</p>
                <hr class="my-0">
                <label class="" for="nombre">Locación</label>
              </div>
              

            </div>
          </div>
        </div>
          
        </div>
    
      </div>
    </div>
  </section>

@endsection