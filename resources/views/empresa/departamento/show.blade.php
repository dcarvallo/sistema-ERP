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
                <label><strong>Nombre</strong> </label>
                <hr class="my-0">
                <label>{{$departamento->nombre}}</label>
              </div>
              <br>
              <div>
                <label class="" for="nombre">Descripción</label>
                <hr class="my-0">
                <label>{{$departamento->descripcion}}</label>
              </div>
              <br>
              <div>
                <label class="" for="nombre">Encargado del departamento</label>
                <hr class="my-0">
                <label>{{$departamento->encargado}}</label>
              </div>
              <br>
              <div>
                <label class="" for="nombre">Ubicacion</label>
                <hr class="my-0">
                <label>{{$departamento->ubicacion->nombre}}</label>
              </div>
              

            </div>
          </div>
        </div>
          
        </div>
    
      </div>
    </div>
  </section>

@endsection