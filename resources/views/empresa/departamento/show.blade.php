@extends('layouts.adminlayout')

@section('icono')
  <i class="fas fa-search-location"></i> 
@endsection

@section('vista', 'Ver departamento')

@section('breadcrumb')  
  <li class="breadcrumb-item"><a href="{{route('departamentos.index')}}">Departamentos</a></li>
  <li class="breadcrumb-item active">Mostrar Departamento</li>
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
                <p class="mb-0">{{$departamento->nombre}}</p>
                <hr class="my-0">
                <label><strong>Nombre</strong> </label>
              </div>
              <br>
              <div>
                <p class="mb-0">{{$departamento->descripcion}}</p>
                <hr class="my-0">
                <label class="" for="nombre">Descripción</label>
              </div>
              <br>
              <div>
                <p class="mb-0">{{$departamento->encargado}}</p>
                <hr class="my-0">
                <label class="" for="nombre">Encargado del departamento</label>
              </div>
              <br>
              <div>
                <p class="mb-0">{{$departamento->ubicacion->nombre}}</p>
                <hr class="my-0">
                <label class="" for="nombre">Ubicacion</label>
              </div>
              

            </div>
          </div>
        </div>
          
        </div>
    
      </div>
    </div>
  </section>

@endsection