@extends('layouts.adminlayout')

@section('icono')
  <i class="fas fa-search-location"></i> 
@endsection

@section('vista', 'Ver Área')

@section('breadcrumb')  
  <li class="breadcrumb-item"><a href="{{route('areas.index')}}">Área</a></li>
  <li class="breadcrumb-item active">Mostrar Área</li>
@endsection

@section('content')

  <section class="content mb-4">
    
    <div class="card card-solid">
      <div class="card-body ">
    
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                  <h5>Información de Área</h5>
              </div>
            <div class="card-body">
              <div>
                <p class="mb-0">{{$area->nombre}}</p>
                <hr class="my-0">
                <label><strong>Nombre</strong> </label>
              </div>
              <br>
              <div>
                <p class="mb-0">{{$area->descripcion}}</p>
                <hr class="my-0">
                <label class="" for="nombre">Descripción</label>
              </div>
              <br>
              <div>
                <p class="mb-0">{{$area->encargado}}</p>
                <hr class="my-0">
                <label class="" for="nombre">Encargado del Área</label>
              </div>
              <br>
              <div>
                <p class="mb-0">{{$area->departamento->nombre}}</p>
                <hr class="my-0">
                <label class="" for="nombre">Departamento</label>
              </div>
              

            </div>
          </div>
        </div>
          
        </div>
    
      </div>
    </div>
  </section>

@endsection