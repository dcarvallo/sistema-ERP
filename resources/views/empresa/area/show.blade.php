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
                <label><strong>Nombre</strong> </label>
                <hr class="my-0">
                <label>{{$area->nombre}}</label>
              </div>
              <br>
              <div>
                <label class="" for="nombre">Descripción</label>
                <hr class="my-0">
                <label>{{$area->descripcion}}</label>
              </div>
              <br>
              <div>
                <label class="" for="nombre">Encargado del Área</label>
                <hr class="my-0">
                <label>{{$area->encargado}}</label>
              </div>
              <br>
              <div>
                <label class="" for="nombre">Departamento</label>
                <hr class="my-0">
                <label>{{$area->departamento->nombre}}</label>
              </div>
              

            </div>
          </div>
        </div>
          
        </div>
    
      </div>
    </div>
  </section>

@endsection